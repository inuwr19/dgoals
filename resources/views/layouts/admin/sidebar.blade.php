<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true"
    data-img="{{ asset('admin') }}/theme-assets/images/backgrounds/02.jpg">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('home') }}"><img class="brand-logo"
                        alt="admin logo" src="{{ asset('customer') }}/img/apple-touch-icon.png" />
                    <h3 class="brand-text">D'Goals</h3>
                </a></li>
            <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="active"><a href="{{ route('home') }}"><i class="ft-home"></i><span class="menu-title"
                        data-i18n="">Dashboard</span></a>
            </li>
            <li class=" nav-item"><a href="{{ route('formAdmin') }}"><i class="ft-layout"></i><span class="menu-title"
                        data-i18n="">Input Product</span></a>
            </li>
        </ul>
    </div>
</div>
