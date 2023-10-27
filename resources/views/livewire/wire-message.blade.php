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
                                <li class="clearfix">
                                    <img src="https://www.pinpng.com/pngs/m/233-2331850_icon-notifications-gambar-broadcast-message-icon-hd-png.png"
                                        alt="avatar">
                                    <div class="about">
                                        <div class="name mt-2 pt-1">Broadcast Message</div>
                                        {{-- <div class="status">

                                        </div> --}}
                                    </div>
                                </li>
                                @foreach ($users as $user)
                                    <li wire:click='updateUser({{ $user->id }})'
                                        class="clearfix {{ $otherUserId === $user->id ? 'active' : '' }}">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                                        <div class="about">
                                            <div class="name">{{ $user->name }}</div>
                                            <div class="status"> <i class="fa fa-circle offline"></i>
                                                {{ $user->department }}
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                    <div class="chat">
                        <div class="chat-header clearfix">
                            <div class="row">
                                <div class="col-lg-6">
                                    @if (!empty($otherUserName) && !empty($otherUserDepartment))
                                        <a href="" data-toggle="modal" data-target="#view_info">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png"
                                                alt="avatar">
                                        </a>

                                        <div class="chat-about">
                                            <h6 class="m-b-0">{{ $otherUserName }}</h6>
                                            <small>{{ $otherUserDepartment }}</small>
                                        </div>
                                    @else
                                        <div class="chat-about">
                                            <h6 class="m-b-0">Start Chat Now</h6>
                                            <small>Security Checking Point</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="chat-history">
                            <ul class="m-b-0">
                                @if (!empty($otherUserId) && !$isEmptyMessage)
                                    @foreach ($messages as $message)
                                        <li class="clearfix">
                                            <div
                                                class="message-data {{ $message->sender_id === auth()->user()->id ? 'text-end' : '' }}">
                                                <span class="message-data-time">
                                                    {{ $message->created_at->format('d-m-Y H:i') }}
                                                </span>
                                            </div>
                                            <div
                                                class="message {{ $message->sender_id === auth()->user()->id ? 'other-message' : 'my-message' }}">
                                                {{ $message->message_content }} </div>
                                        </li>
                                    @endforeach
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
                        <div class="chat-message clearfix">
                            <form wire:submit.prevent='sendMessage' enctype="multipart/form-data">
                                {{-- <div class="row">
                                    <div class="col-md-1">
                                        <label for="fileInput" class="custom-button">
                                            <i class="fa fa-paperclip fa-2xl"></i>
                                        </label>
                                        <input type="file" id="fileInput" accept="image/*">
                                    </div> --}}
                                {{-- <div class="col-md-11"> --}}
                                <div class="input-group mb-3">
                                    <input wire:model='messageContent' type="text" class="form-control"
                                        placeholder="Your message here">
                                    <span class="input-group-text bg-navy text-white">
                                        <i class="fa fa-send"></i>
                                    </span>
                                </div>
                                {{-- </div> --}}
                                {{-- </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
