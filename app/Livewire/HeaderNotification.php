<?php

namespace App\Livewire;

use App\Models\Message;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class HeaderNotification extends Component
{
    public $countMessageNotification;

    public function mount()
    {
        $this->getCountMessageNotification();
    }

    #[On('count-unread-updated')]
    public function getCountMessageNotification()
    {
        $currentUser = auth()->user()->id;

        $countMessage = DB::table(DB::raw('(SELECT COUNT(id) AS total FROM messages WHERE receiver_id=' . $currentUser . ' AND is_read=false GROUP BY sender_id) AS subquery'))
            ->select(DB::raw('COUNT(total) AS total'))
            ->value('total');

        $this->countMessageNotification = $countMessage;
    }

    public function setRedirectUserMessage($user)
    {
        return redirect()->route('message', ['action' => 'updateUser', 'user' => $user]);
    }

    public function render()
    {
        $currentUser = auth()->user()->id;

        $unreadMessages = Message::whereIn('id', function ($query) use ($currentUser) {
            $query->select(DB::raw('MIN(id)'))
                ->from('messages')
                ->where('receiver_id', $currentUser)
                ->where('is_read', false)
                ->groupBy('sender_id');
        })
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        return view('livewire.components.header-notification', [
            'unreads' => $unreadMessages
        ]);
    }
}