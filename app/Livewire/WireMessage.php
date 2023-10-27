<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class WireMessage extends Component
{
    public $otherUserId;
    public $otherUserName;
    public $otherUserDepartment;
    public $messages;
    public $isEmptyMessage = false;
    public $users;
    public $searchReceiver;
    public $messageContent;

    // public function mount($userId) {

    // }

    public function updateUser($user)
    {
        $userData = User::where('id', $user);
        $name = $userData->first()->name;
        $division = $userData->first()->divisi;

        $this->otherUserId = $user;
        $this->otherUserName = $name;
        $this->otherUserDepartment = $division;
    }

    public function loadMessages()
    {
        // if (!empty($this->otherUserId)) {
        $checkMessages = Message::whereIn('sender_id', [$this->otherUserId, auth()->user()->id])
            ->whereIn('receiver_id', [$this->otherUserId, auth()->user()->id])
            ->orderBy('created_at', 'desc')
            ->get();
        // }

        if ($checkMessages->count() > 0) {
            $this->messages = $checkMessages;
            $this->isEmptyMessage = false;
        } else {
            $this->isEmptyMessage = true;
        }
    }

    public function loadUsers()
    {
        $this->users = User::where('id', '!=', auth()->user()->id)
            ->where('name', 'LIKE', '%' . $this->searchReceiver . '%')
            ->get();
    }

    public function sendMessage()
    {
        Message::create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $this->otherUserId,
            'message_content' => $this->messageContent
        ]);

        $this->reset('messageContent');
    }

    public function render()
    {
        $this->loadMessages();
        $this->loadUsers();

        return view('livewire.wire-message');
    }
}