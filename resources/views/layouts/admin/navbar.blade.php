<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="collapse n\avbar-collapse show" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-block d-md-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                            href="#"><i class="ft-menu"></i></a></li>
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i
                                class="ficon ft-maximize"></i></a></li>
                    <li class="nav-item dropdown navbar-search"><a class="nav-link dropdown-toggle hide"
                            data-toggle="dropdown" href="#"><i class="ficon ft-search"></i></a>
                        <ul class="dropdown-menu">
                            <li class="arrow_box">
                                <form>
                                    <div class="input-group search-box">
                                        <div class="position-relative has-icon-right full-width">
                                            <input class="form-control" id="search" type="text"
                                                placeholder="Search here...">
                                            <div class="form-control-position navbar-search-close"><i class="ft-x"> </i>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                            href="#" data-toggle="dropdown"> <span class="avatar avatar-online"><img
                                    src="{{ asset('admin') }}/theme-assets/images/portrait/small/avatar-s-19.png"
                                    alt="avatar"><i></i></span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="arrow_box_right"><a class="dropdown-item" href="#"><span
                                        class="avatar avatar-online"><img
                                            src="{{ asset('admin') }}/theme-assets/images/portrait/small/avatar-s-19.png" alt="avatar"><span
                                            class="user-name text-bold-700 ml-1">John Doe</span></span></a>
                                <div class="dropdown-divider">

                                </div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                {{-- <a class="dropdown-item" href="#">
                                    <i class="ft-power">
                                        </i> Logout
                                    </a> --}}
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
