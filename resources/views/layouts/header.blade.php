<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="float-start">
                    <div class="hamburger sidebar-toggle">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>
                </div>
                <div class="float-start ms-2">
                    <div class="hamburger">
                        <h5>Dashboard</h5>
                    </div>
                </div>
                <div class="float-end">

                    @livewire('header-notification')

                    <div class="dropdown dib">
                        <div class="header-icon" data-bs-toggle="dropdown">

                            @if (!auth()->user()->foto)
                                <img class="pull-left m-r-10 mt-1 avatar-img" src="{{ asset('img/logo/user.png') }}"
                                    alt="" />
                            @else
                                <img class="pull-left m-r-10 mt-1 avatar-img"
                                    src="{{ asset('storage/img/user-image/' . auth()->user()->foto) }}"
                                    alt="" />
                            @endif

                            <span class="user-avatar">{{ auth()->user()->username }}
                                <i class="ti-angle-down f-s-10"></i>
                            </span>
                            <div class="drop-down dropdown-profile dropdown-menu dropdown-menu-right">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="/message">
                                                <i class="ti-email"></i>
                                                <span>Inbox</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="ti-settings"></i>
                                                <span>Setting</span>
                                            </a>
                                        </li>
                                        @livewire('wire-logout')
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
