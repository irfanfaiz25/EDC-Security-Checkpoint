<?php

namespace App\Livewire;

use App\Models\Message;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class SidebarMessageCount extends Component
{
    public $sidebarUnreadUserMessageCount;


    public function mount()
    {
        $this->getSidebarUnreadUserMessageCount();
    }

    #[On('count-unread-updated')]
    public function getSidebarUnreadUserMessageCount()
    {
        $userReceiver = auth()->user()->id;
        // $messageUnread = Message::where('receiver_id', $userReceiver)
        //     ->where('is_read', false)
        //     ->groupBy('sender_id')
        //     ->count();
        $messageUnread = DB::table(DB::raw('(SELECT COUNT(id) AS total FROM messages WHERE receiver_id=' . $userReceiver . ' AND is_read=false GROUP BY sender_id) AS subquery'))
            ->select(DB::raw('COUNT(total) AS total'))
            ->value('total');

        $this->sidebarUnreadUserMessageCount = $messageUnread;
    }

    public function render()
    {
        return view('livewire.components.sidebar-message-count');
    }
}