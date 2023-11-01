    <li>
        <a href="/message"><i class="fa fa-envelope"></i> Message
            @if ($sidebarUnreadUserMessageCount > 0)
                <span class="badge text-bg-danger fw-medium">
                    {{ $sidebarUnreadUserMessageCount }}
                </span>
            @endif
        </a>
    </li>
