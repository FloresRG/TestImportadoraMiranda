<nav class="main-header navbar custom-navbar
   {{ config('adminlte.classes_topnav_nav', 'navbar-expand') }}
   {{ config('adminlte.classes_topnav', 'navbar-white navbar-light') }}">

    {{-- Navbar left links --}}
    <ul class="navbar-nav">
        @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler')
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')
        @yield('content_top_nav_left')
    </ul>

    {{-- Navbar right links --}}
    <ul class="navbar-nav ml-auto">
        @yield('content_top_nav_right')
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-right'), 'item')
        @if(config('adminlte.layout_dark_mode'))
            <li class="nav-item">
                <x-adminlte-navbar-darkmode-widget />
            </li>
        @endif
        @if(Auth::user())
            @if(config('adminlte.usermenu_enabled'))
                @include('adminlte::partials.navbar.menu-item-dropdown-user-menu')
            @else
                @include('adminlte::partials.navbar.menu-item-logout-link')
            @endif
        @endif
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.navbar.menu-item-right-sidebar-toggler')
        @endif
    </ul>

   <style>
    .custom-navbar {
        background: linear-gradient(135deg, #cc9efd 0%, #cc9efd 25%, #a582ff 50%,  #a582ff 75%, #3b78d8 100%) !important;
    }

    .main-header.navbar .nav-link,
    .main-header.navbar .nav-link *,
    .main-header.navbar i,
    .main-header.navbar svg {
         color: #1b003a !important;
        fill: #1b003a !important;
        font-size: 1.1em; /* más pequeño */
        transition: transform 0.2s ease, color 0.2s ease;
        cursor: pointer;
        margin: 0 0.1em; /* separa íconos */
        vertical-align: middle;
    }

   /* Al pasar el mouse */
.main-header.navbar .nav-link i:hover,
.main-header.navbar .nav-link svg:hover {
    transform: scale(2.2);
}

    /* Al hacer click */
    .main-header.navbar .nav-link i:active,
    .main-header.navbar .nav-link svg:active {
        transform: scale(2);
    }

      /* Ícono activo → se mantiene grande */
    .main-header.navbar .nav-link.active i,
    .main-header.navbar .nav-link.active svg {
        transform: scale(2);
    }

    /* Hover en íconos activos → aún más grande */
    .main-header.navbar .nav-link.active i:hover,
    .main-header.navbar .nav-link.active svg:hover {
        transform: scale(2.2);
    }

    /* Hover en íconos NO activos */
    .main-header.navbar .nav-link:not(.active) i:hover,
    .main-header.navbar .nav-link:not(.active) svg:hover {
        transform: scale(1.3);
    }

    /* Dark Mode Styles for Navbar */
    .dark-mode .custom-navbar {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 25%, #3b3b3b 50%, #4a4a4a 75%, #4a4a4a 100%) !important;
    }

    .dark-mode .main-header.navbar .nav-link,
    .dark-mode .main-header.navbar .nav-link *,
    .dark-mode .main-header.navbar i,
    .dark-mode .main-header.navbar svg {
        color: #ffffff !important;
        fill: #ffffff !important;
    }

 </style>


</nav>
