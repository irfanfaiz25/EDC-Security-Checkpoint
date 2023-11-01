{{-- <div> --}}
<div class="dropdown dib">
    <div class="header-icon" data-bs-toggle="dropdown">

        @if ($countMessageNotification > 0)
            <span class="position-absolute top-2 translate-middle badge rounded-pill text-bg-danger">
                {{ $countMessageNotification }}
            </span>
        @endif

        <i class="ti-bell"></i>
        <div class="drop-down dropdown-menu dropdown-menu-right">
            <div class="dropdown-content-heading">
                <span class="text-left">Recent Notifications</span>
            </div>
            <div class="dropdown-content-body">
                <ul>

                    @if ($countMessageNotification > 0)
                        @foreach ($unreads as $unread)
                            <li>
                                <a wire:click='setRedirectUserMessage({{ $unread->users->id }})'>
                                    <img class="pull-left m-r-10 avatar-img" src="" alt="" />
                                    <div class="notification-content">
                                        <small class="notification-timestamp pull-right">
                                            {{ $unread->created_at->format('H:i') }}
                                        </small>
                                        <div class="notification-heading">
                                            {{ $unread->users->name }}
                                        </div>
                                        <div class="notification-text">
                                            @if (!empty($unread->message_content) && empty($message_image))
                                                {{ $unread->message_content }}
                                            @elseif (
                                                (!empty($unread->message_content) && !empty($message_image)) ||
                                                    (empty($unread->message_content) && !empty($message_image)))
                                                Sent a photo.
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li>
                            <p class="text-center">
                                there's no notification.
                            </p>
                        </li>
                    @endif

                    <li class="text-center">
                        <a href="/message" class="more-link">See All Messages</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
{{-- </div> --}}
