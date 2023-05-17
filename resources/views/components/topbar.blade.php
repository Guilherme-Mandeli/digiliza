<div class="navbar-custom">

    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
        <li>
            <button class="button-menu-mobile disable-btn waves-effect">
                <i class="fe-menu"></i>
            </button>
        </li>
    </ul>

    <div id="navbar_search" class="d-inline-block">
        <div id="search_app" class="my-2">
            <h1 id="top-search" class="d-inline">@yield('page_title')</h1>
            <div class="titlebar__breadcrumb d-inline-block">
                <div class="col-md-12 breadcrumb_wrapper">
                    <ol class="breadcrumb"></ol>
                </div>
            </div>
        </div>
    </div>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="/" class="logo logo-light text-center">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="50">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="50">
            </span>
        </a>
        <a href="/" class="logo logo-dark text-center">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="50">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="50">
            </span>
        </a>
    </div>

    <div class="clearfix"></div>

</div>
