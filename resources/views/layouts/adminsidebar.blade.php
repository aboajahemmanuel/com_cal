<div class="nk-sidebar nk-sidebar-fixed " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="{{ url('dashboard') }}" class="nk-nav-toggle nk-quick-nav-icon d-xl-none"
                data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
            <a href="{{ url('dashboard') }}" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex"
                data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-sidebar-brand">
            <a href="{{ url('dashboard') }}" class="logo-link">
                <img class="logo-light logo-img logo-img-lg" src="{{ asset('asset/images/logo.png') }}"
                    srcset="{{ asset('asset/images/logo.png') }} 2x" alt="logo">
                <img class="logo-dark logo-img logo-img-lg" src="{{ asset('asset/images/logo.png') }}"
                    srcset="{{ asset('asset/images/logo.png') }} 2x" alt="logo-dark">
            </a>
        </div>

    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element nk-sidebar-body" style="background-color: #23346A">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-item">
                        <a href="{{ route('dashboard') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                            <span class="nk-menu-text" style="color: white">Dashboard</span>
                        </a>
                    </li><!-- .nk-menu-item -->




                    <li class="nk-menu-item has-sub">
                        <a href="{{ url('categories') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-card-view"></em></span>
                            <span class="nk-menu-text" style="color: white">Corporate Action Categories</span>
                        </a>

                    </li>






                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-task-fill-c"></em></span>
                            <span class="nk-menu-text" style="color: white">Events</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ url('events') }}" class="nk-menu-link"><span class="nk-menu-text"
                                        style="color: white">All
                                        Events</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('pendingEvents') }}" class="nk-menu-link"><span class="nk-menu-text"
                                        style="color: white">Pending Events </span></a>
                            </li>
                        </ul>
                    </li>


                    <li class="nk-menu-item has-sub">
                        <a href="{{ url('issuers') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-card-view"></em></span>
                            <span class="nk-menu-text" style="color: white">Issuers</span>
                        </a>

                    </li>

                     <li class="nk-menu-item has-sub">
                            <a href="{{ url('users') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                                <span class="nk-menu-text" style="color: white">Users</span>
                            </a>

                        </li>



                    @if (Auth::user()->hasRole('super_admin'))
                        {{-- <li class="nk-menu-item has-sub">
                            <a href="{{ url('users') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                                <span class="nk-menu-text" style="color: white">Users</span>
                            </a>

                        </li> --}}

                        <li class="nk-menu-item has-sub">
                            <a href="{{ url('roles') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-task-fill-c"></em></span>
                                <span class="nk-menu-text" style="color: white">Roles</span>
                            </a>

                        </li>


                        <li class="nk-menu-item has-sub">
                            <a href="{{ url('logActivity') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-card-view"></em></span>
                                <span class="nk-menu-text" style="color: white">Log Activities</span>
                            </a>

                        </li>
                    @endif

                    <li class="nk-menu-item has-sub">
                        <a href="{{ url('/') }}" class="nk-menu-link" target="_blank">
                            <span class="nk-menu-icon"><em class="icon ni ni-card-view"></em></span>
                            <span class="nk-menu-text" style="color: white">View Calendar</span>
                        </a>

                    </li>

                </ul>
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>
