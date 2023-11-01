<div>
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card .card-chat chat-app">
                    <div id="plist" class="people-list">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-navy text-white">
                                <i class="fa fa-searchengin"></i>
                            </span>
                            <input wire:model.live.debounce.200ms='searchReceiver' type="text" class="form-control"
                                placeholder="Search ...">
                        </div>

                        <div class="longEnough mCustomScrollbar" data-mcs-theme="dark">
                            <ul class="list-unstyled chat-list mt-2 mb-0">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" id="dropdownMenuLink"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <li class="clearfix">
                                            <img src="https://www.pinpng.com/pngs/m/233-2331850_icon-notifications-gambar-broadcast-message-icon-hd-png.png"
                                                alt="avatar">
                                            <div class="about">
                                                <div class="name mt-2 pt-1">Broadcast Message</div>
                                            </div>
                                        </li>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <!-- Dropdown items go here -->
                                        @foreach ($departments as $department)
                                            <a wire:click="setBroadcastMessage('{{ $department }}')"
                                                class="dropdown-item">{{ ucfirst($department) }}</a>
                                        @endforeach
                                    </div>
                                </div>
                                @if ($users->count() > 0)
                                    @foreach ($users as $user)
                                        <li wire:click="updateUser({{ $user->id }})"
                                            class="clearfix {{ $otherUserId === $user->id ? 'active' : '' }}">
                                            {{-- <div class="row"> --}}
                                            <div class="col-auto">
                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                    alt="avatar">
                                                <div class="about">
                                                    <div class="name">{{ $user->name }}</div>
                                                    <div class="status"> <i class="fa fa-circle offline"></i>
                                                        {{ $user->department }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto text-end">
                                                @if ($user->unreadCount > 0)
                                                    <span class="badge text-bg-danger m-2">
                                                        {{ $user->unreadCount }}
                                                    </span>
                                                @endif
                                            </div>
                                            {{-- </div> --}}
                                        </li>
                                    @endforeach
                                @else
                                    <p class="text-center mt-2">No users found.</p>
                                @endif
                            </ul>
                        </div>

                    </div>
                    <div class="chat">
                        <div class="chat-header clearfix">
                            <div class="row">
                                <div class="col-lg-12">
                                    @if (!empty($otherUserName) && !empty($otherUserDepartment))
                                        <a href="" data-toggle="modal" data-target="#view_info">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png"
                                                alt="avatar">
                                        </a>

                                        <div class="chat-about">
                                            <h6 class="m-b-0">{{ $otherUserName }}</h6>
                                            <small>{{ $otherUserDepartment }}</small>
                                        </div>

                                        <div class="dropdown">
                                            <span class="text-end float-end dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class="fa fa-ellipsis-vertical"></i>
                                            </span>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    @if (!$isDelete)
                                                        <a wire:click='setDeleteChat' class="dropdown-item">
                                                            Delete Chat
                                                        </a>
                                                    @else
                                                        <a wire:click='cancelDeleteChat' class="dropdown-item">
                                                            Cancel Delete Chat
                                                        </a>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                    @endif

                                    @if (!empty($sendBroadcastMessageTo))
                                        <a href="" data-toggle="modal" data-target="#view_info">
                                            <img src="https://www.pinpng.com/pngs/m/233-2331850_icon-notifications-gambar-broadcast-message-icon-hd-png.png"
                                                alt="avatar">
                                        </a>

                                        <div class="chat-about">
                                            <h6 class="m-b-0">
                                                To : {{ $sendBroadcastMessageTo }} Department
                                            </h6>
                                            <small>Broadcast Message</small>
                                        </div>
                                    @endif

                                    @if (empty($otherUserName) && empty($otherUserDepartment) && empty($sendBroadcastMessageTo))
                                        <div class="chat-about">
                                            <h6 class="m-b-0">Start Chat Now</h6>
                                            <small>Security Checking Point</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <form wire:submit.prevent='deleteSelectedChat'>
                            <div class="chat-history">
                                <ul class="m-b-0">
                                    @if (!empty($otherUserId) && !$isEmptyMessage)
                                        @foreach ($messages as $message)
                                            <li class="clearfix">
                                                @if ($isDelete && $message->sender_id === auth()->user()->id)
                                                    <div class="text-end float-end mx-2">
                                                        <input wire:model='selectedDeletedMessage'
                                                            value="{{ $message->id }}" type="checkbox"
                                                            class="form-check-input">
                                                    </div>
                                                @endif
                                                <div
                                                    class="message-data {{ $message->sender_id === auth()->user()->id ? 'text-end' : '' }}">
                                                    <span class="message-data-time">
                                                        {{ $message->created_at->format('d-m-Y H:i') }}
                                                    </span>
                                                </div>
                                                @if ($message->message_image)
                                                    @if ($message->sender_id === auth()->user()->id)
                                                        <div class="row d-flex justify-content-end">
                                                            <div class="col-auto">
                                                                <a href="{{ asset('storage/img/user-upload/' . $message->message_image) }}"
                                                                    download>
                                                                    <span class="fs-5 text-navy download-image-btn">
                                                                        <i class="fa fa-download fa-2xl"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="message other-message">
                                                                    <img id="image-message"
                                                                        data-image="{{ asset('storage/img/user-upload/' . $message->message_image) }}"
                                                                        src="{{ asset('storage/img/user-upload/' . $message->message_image) }}"
                                                                        alt="image-upload">
                                                                    <div
                                                                        class="row m-1 pt-1 text-wrap text-start text-image">
                                                                        {{ $message->message_content }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row d-flex justify-content-start">
                                                            <div class="col-auto">
                                                                <div class="message my-message">
                                                                    <img id="image-message"
                                                                        data-image="{{ asset('storage/img/user-upload/' . $message->message_image) }}"
                                                                        src="{{ asset('storage/img/user-upload/' . $message->message_image) }}"
                                                                        alt="image-upload">
                                                                    <div
                                                                        class="row m-1 pt-1 text-wrap text-start text-image">
                                                                        {{ $message->message_content }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <a href="{{ asset('storage/img/user-upload/' . $message->message_image) }}"
                                                                    download>
                                                                    <span class="fs-5 text-navy download-image-btn">
                                                                        <i class="fa fa-download fa-2xl"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @elseif ($message->message_content)
                                                    <div
                                                        class="message {{ $message->sender_id === auth()->user()->id ? 'other-message' : 'my-message' }}">
                                                        {{ $message->message_content }}
                                                    </div>
                                                @endif
                                            </li>
                                        @endforeach
                                    @elseif (empty($otherUserId) && session()->has('sent'))
                                        <div class="row d-flex justify-content-center mt-5">
                                            <div class="col-md-6 text-center">
                                                <h2>Broadcast Message Sent !</h2>
                                                <small>{{ session('sent') }}</small>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row d-flex justify-content-center mt-5">
                                            <div class="col-md-6 text-center">
                                                <h2>Start Chat</h2>
                                                <small>no chats found.</small>
                                            </div>
                                        </div>
                                    @endif
                                </ul>

                            </div>
                            @if ($isDelete)
                                <div class="row">
                                    <div class="col-md-12 text-end float-end">
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </form>
                        <div class="chat-message clearfix">
                            @if (session()->has('emptyMessage'))
                                <div class="row d-flex">
                                    <div class="col-md-12 text-center">
                                        <i class="fa fa-triangle-exclamation text-danger"></i>
                                        <span class="text-danger fw-medium">
                                            {{ session('emptyMessage') }}
                                        </span>
                                    </div>
                                </div>
                            @endif
                            @if (session()->has('emptyDeleteId'))
                                <div class="row d-flex">
                                    <div class="col-md-12 text-center">
                                        <i class="fa fa-triangle-exclamation text-danger"></i>
                                        <span class="text-danger fw-medium">
                                            {{ session('emptyDeleteId') }}
                                        </span>
                                    </div>
                                </div>
                            @endif
                            <form wire:submit.prevent='sendMessage' enctype="multipart/form-data">
                                <div class="row">
                                    @if ($image)
                                        <div class="col-md-12">
                                            <img id="user-upload" src="{{ $image->temporaryUrl() }}"
                                                alt="user-upload">
                                            <span wire:click='setImageNull'>
                                                <i class="fa fa-circle-xmark text-danger ms-2"></i>
                                            </span>
                                        </div>
                                    @endif

                                    <div class="col-md-1">
                                        @if ($otherUserId != '' || $sendBroadcastMessageTo != '')
                                            <label for="fileInput" class="custom-button">
                                                <i class="fa fa-paperclip fa-2xl"></i>
                                            </label>
                                            <input wire:model='image' type="file" id="fileInput"
                                                accept="image/*">
                                        @endif
                                    </div>
                                    <div class="col-md-11">
                                        <div class="input-group mb-3">
                                            @if ($otherUserId == '' && $sendBroadcastMessageTo == '')
                                                <input type="text" class="form-control"
                                                    placeholder="Your message here" disabled>
                                                <span class="input-group-text bg-secondary text-white">
                                                    <button type="submit" class="btn btn-secondary" disabled>
                                                        <i class="fa fa-send"></i>
                                                    </button>
                                                </span>
                                            @else
                                                <input wire:model='messageContent' type="text"
                                                    class="form-control 
                                                    @if (session()->has('emptyMessage')) is-invalid @endif"
                                                    placeholder="Your message here" autofocus>
                                                <span class="input-group-text bg-navy text-white">
                                                    <button type="submit" class="btn btn-send-message">
                                                        <i class="fa fa-send"></i>
                                                    </button>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="uploadedImage" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <img id="modalImage" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

    </div>
