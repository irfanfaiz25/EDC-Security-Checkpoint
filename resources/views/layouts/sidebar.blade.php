<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <ul>
                <div class="logo"><a href="/">
                        <img src="" alt="" /><span>EDC</span></a></div>
                <li><a href="/"><i class="fa fa-layer-group"></i> Dashboard </a></li>
                <li class="label">Apps</li>
                @if (auth()->user()->username === 'fauzi' || auth()->user()->department === 'Security')
                    <li><a class="sidebar-sub-toggle"><i class="fa fa-map-pin"></i> Chekpoints <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="/scan-office1">Office L.1</a></li>
                            <li><a href="/scan-office2">Office L.2</a></li>
                            <li><a href="/scan-dmc1">DMC L.1</a></li>
                            <li><a href="/scan-dmc2">DMC L.2</a></li>
                            <li><a href="/scan-outdoor">Outdoor</a></li>
                            {{-- <li><a href="chart-morris.html">Data list</a></li> --}}
                        </ul>
                    </li>
                @endif
                <li><a href="/checkpoint"><i class="fa fa-map-location-dot"></i> Data Checkpoint </a></li>
                <li><a href="/scan-history"><i class="fa fa-user-clock"></i> Scan History </a></li>

                @livewire('sidebar-message-count')

                @if (auth()->user()->username === 'fauzi')
                    <li class="label mt-2">Setting</li>
                    <li><a href="/user-management"><i class="fa fa-gear"></i> User Management </a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- /# sidebar -->
