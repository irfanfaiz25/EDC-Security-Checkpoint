<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

class WireMessage extends Component
{
    use WithFileUploads;

    public $otherUserId;
    public $otherUserName;
    public $otherUserDepartment;

    // public $messages;
    public $isEmptyMessage = false;
    public $messageContent;
    public $sendBroadcastMessageTo;
    public $countUnreadChat;
    public $isDelete = false;
    public $selectedDeletedMessage = [];
    public $isModalVisible = false;
    public $imageUrl;

    public $searchReceiver;
    public $departments;

    #[Rule('image|max:2048')]
    public $image;


    public function mount()
    {
        $action = request('action', null);
        $user = request('user', null);

        if ($action === 'updateUser' && $user !== null) {
            $this->updateUser((integer) $user);
        }
    }

    public function showImageModal($imageUrl)
    {
        // dd($imageUrl);
        $this->imageUrl = $imageUrl;
        $this->isModalVisible = true;
    }

    public function hideImageModal()
    {
        $this->isModalVisible = false;
    }

    public function setDeleteChat()
    {
        $this->isDelete = true;
    }

    public function cancelDeleteChat()
    {
        $this->isDelete = false;
    }

    public function deleteSelectedChat()
    {
        if (!empty($this->selectedDeletedMessage)) {
            Message::whereIn('id', $this->selectedDeletedMessage)->delete();

            $this->selectedDeletedMessage = [];
        } else {
            session()->flash('emptyDeleteId', 'Tidak ada pesan yang di pilih !');
        }

    }

    public function getCountUnreadChat($sender)
    {
        $receiver = auth()->user()->id;

        $countChat = Message::where('receiver_id', $receiver)
            ->where('sender_id', $sender)
            ->where('is_read', false)
            ->count();

        $this->countUnreadChat = $countChat;
    }

    public function setImageNull()
    {
        $this->image = '';
    }

    public function setBroadcastMessage($target)
    {
        $this->sendBroadcastMessageTo = $target;

        $this->reset('otherUserName', 'otherUserId', 'otherUserDepartment');
    }

    #[On('redirectAndUpdateUser')]
    public function updateUser($user)
    {
        $userData = User::where('id', $user);
        $name = $userData->first()->name;
        $department = $userData->first()->department;
        $currentUser = auth()->user()->id;

        $this->otherUserId = $user;
        $this->otherUserName = $name;
        $this->otherUserDepartment = $department;

        $countUnreadMessage = Message::where('sender_id', $user)
            ->where('receiver_id', $currentUser);

        $countUnreadMessage->update([
            'is_read' => true
        ]);

        $this->dispatch('count-unread-updated');

        $this->reset('sendBroadcastMessageTo');
    }

    public function loadMessages()
    {
        $checkMessages = Message::whereIn('sender_id', [$this->otherUserId, auth()->user()->id])
            ->whereIn('receiver_id', [$this->otherUserId, auth()->user()->id])
            ->orderBy('created_at', 'desc')
            ->get();

        if ($checkMessages->count() > 0) {
            // $this->messages = $checkMessages;
            $this->isEmptyMessage = false;
        } else {
            $this->isEmptyMessage = true;
        }
    }

    public function storeImage()
    {
        $userUploader = auth()->user()->username;
        $currentTimeUpload = now()->format('Y-m-d-H.i.s');

        if ($this->image) {
            $imageName = $this->image;
            $imageExtension = $imageName->extension();
            $newImageName = $userUploader . '-' . $currentTimeUpload . '.' . $imageExtension;
            $this->image->storeAs('public/img/user-upload', $newImageName);
            return $newImageName;
        }

        return null;
    }

    public function sendMessage()
    {
        $senderId = auth()->user()->id;
        $otherUserId = $this->otherUserId;
        $broadcastTarget = $this->sendBroadcastMessageTo;

        if (empty($this->image) && !empty($this->messageContent)) {
            $messageContent = $this->messageContent;
            $imageUpload = '';
        } elseif (!empty($this->image) && empty($this->messageContent)) {
            $messageContent = '';
            $imageUpload = $this->storeImage();
        } elseif (!empty($this->image) && !empty($this->messageContent)) {
            $messageContent = $this->messageContent;
            $imageUpload = $this->storeImage();
        } else {
            session()->flash('emptyMessage', 'Pesan tidak boleh kosong !');
            return false;
        }

        if (!empty($otherUserId) && empty($broadcastTarget)) {

            Message::create([
                'sender_id' => $senderId,
                'receiver_id' => $otherUserId,
                'message_content' => $messageContent,
                'message_image' => $imageUpload
            ]);

            $this->reset('messageContent', 'image');

        } elseif (!empty($broadcastTarget) && empty($otherUserId)) {
            $broadcastUsers = User::where('department', $broadcastTarget)
                ->where('id', '!=', $senderId)
                ->get();
            $broadcastCount = $broadcastUsers->count();

            foreach ($broadcastUsers as $user) {
                Message::create([
                    'sender_id' => $senderId,
                    'receiver_id' => $user->id,
                    'message_content' => $messageContent,
                    'message_image' => $imageUpload
                ]);
            }

            $this->reset('messageContent', 'sendBroadcastMessageTo', 'image');

            session()->flash('sent', 'Sent To : ' . $broadcastCount . ' ' . $broadcastTarget . ' users');
        }

    }

    public function render()
    {
        $this->loadMessages();

        $this->departments = User::distinct()->pluck('department');

        $users = User::where('id', '!=', auth()->user()->id)
            ->where('name', 'like', "%$this->searchReceiver%")
            ->get();

        $userWithUnreadCount = $users->map(function ($user) {
            $currentUser = auth()->user()->id;

            $unreadCount = Message::where('sender_id', $user->id)
                ->where('receiver_id', $currentUser)
                ->where('is_read', false)
                ->count();

            $user->unreadCount = $unreadCount;
            return $user;
        });

        return view('livewire.wire-message', [
            'users' => $userWithUnreadCount,
            'messages' => Message::whereIn('sender_id', [$this->otherUserId, auth()->user()->id])
                ->whereIn('receiver_id', [$this->otherUserId, auth()->user()->id])
                ->orderBy('created_at', 'desc')
                ->get()
        ]);
    }
}