<?php return array (
  2 => 'broadcasting',
  7 => 'hashing',
  13 => 'view',
  'adminlte' => 
  array (
    'title' => 'IMPORTADORA MIRANDA',
    'title_prefix' => '',
    'title_postfix' => '',
    'use_ico_only' => false,
    'use_full_favicon' => false,
    'google_fonts' => 
    array (
      'allowed' => true,
    ),
    'logo' => '<b class="logo-importadora">Importadora</b> <b class="logo-miranda">Miranda</b>',
    'logo_img' => 'images/logo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => NULL,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',
    'auth_logo' => 
    array (
      'enabled' => false,
      'img' => 
      array (
        'path' => 'images/logo.png',
        'alt' => 'Auth Logo',
        'class' => '',
        'width' => 50,
        'height' => 50,
      ),
    ),
    'preloader' => 
    array (
      'enabled' => true,
      'mode' => 'fullscreen',
      'img' => 
      array (
        'path' => 'images/logo.png',
        'alt' => 'AdminLTE Preloader Image',
        'effect' => 'animation__shake',
        'width' => 200,
        'height' => 200,
      ),
    ),
    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,
    'layout_topnav' => NULL,
    'layout_boxed' => NULL,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => NULL,
    'layout_fixed_footer' => NULL,
    'layout_dark_mode' => true,
    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',
    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-purple elevation-4 sidebar-gradient',
    'classes_sidebar_nav' => 'sidebar-letter-white',
    'classes_topnav' => 'sidebar-purple elevation-4 ',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',
    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,
    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'light',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',
    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,
    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',
    'menu' => 
    array (
      0 => 
      array (
        'text' => '',
        'url' => '/analisis',
        'icon' => 'fas fa-chart-bar',
        'topnav_right' => true,
        'can' => 'users.index',
      ),
      1 => 
      array (
        'text' => '',
        'url' => 'registros',
        'icon' => 'fas fa-book-open',
        'icon_color' => 'primary',
        'topnav_right' => true,
        'can' => 'pedidos.index',
      ),
      2 => 
      array (
        'text' => '',
        'url' => '/planilla-pagos',
        'icon' => 'fas fa-credit-card',
        'topnav_right' => true,
        'can' => 'users.index',
      ),
      3 => 
      array (
        'text' => '',
        'url' => 'carpetas',
        'icon' => 'fas fa-camera-retro',
        'icon_color' => 'primary',
        'topnav_right' => true,
        'can' => 'pedidos.index',
      ),
      4 => 
      array (
        'text' => '',
        'url' => '/precioproductos',
        'icon' => 'fas fa-money-check-alt',
        'topnav_right' => true,
      ),
      5 => 
      array (
        'text' => '',
        'url' => '/notas',
        'icon' => 'fas fa-calendar-alt',
        'topnav_right' => true,
      ),
      6 => 
      array (
        'text' => '',
        'url' => '/change-password',
        'icon' => 'fas fa-lock-open',
        'topnav_right' => true,
      ),
      7 => 
      array (
        'text' => '',
        'url' => '/proveedores',
        'icon' => 'fas fa-user-circle',
        'can' => 'proveedores.index',
        'topnav_right' => true,
      ),
      8 => 
      array (
        'text' => '',
        'url' => '/solicitudes',
        'icon' => 'fas fa-file-signature',
        'topnav_right' => true,
        'can' => 'pedidos.index',
      ),
      9 => 
      array (
        'type' => 'sidebar-menu-search',
        'text' => 'search',
      ),
      10 => 
      array (
        'text' => 'blog',
        'url' => 'admin/blog',
        'can' => 'manage-blog',
      ),
      11 => 
      array (
        'text' => 'Reporte Caja',
        'url' => '/caja-sucursal',
        'icon' => 'fas fa-fw fa-share',
        'can' => 'caja_sucursal.index',
      ),
      12 => 
      array (
        'text' => 'Cuaderno sucursal',
        'url' => '/envioscuadernosucursal',
        'icon' => 'fas fa-book-open',
        'can' => 'pedidos.index',
      ),
      13 => 
      array (
        'text' => 'Gestion de Usuarios',
        'icon' => 'fas fa-users',
        'submenu' => 
        array (
          0 => 
          array (
            'text' => 'Roles',
            'url' => 'roles',
            'icon' => 'fas fa-user',
            'can' => 'roles.index',
          ),
          1 => 
          array (
            'text' => 'Usuarios',
            'url' => 'users',
            'icon' => 'fas fa-user',
            'can' => 'users.index',
          ),
        ),
      ),
      14 => 
      array (
        'text' => 'Cuaderno',
        'icon' => 'fas fa-book',
        'submenu' => 
        array (
          0 => 
          array (
            'text' => 'Cuaderno Completo',
            'url' => '/envioscuaderno',
            'icon' => 'fas fa-book-open',
            'can' => 'pedidos.index',
          ),
          1 => 
          array (
            'text' => 'Cuaderno Sin Marcados',
            'url' => '/envioscuaderno/sinmarcados',
            'icon' => 'fas fa-book-open',
            'can' => 'pedidos.index',
          ),
          2 => 
          array (
            'text' => 'Cuaderno Sin La Paz',
            'url' => '/envioscuaderno/sinlapaz',
            'icon' => 'fas fa-map-marker-alt',
            'can' => 'pedidos.index',
          ),
          3 => 
          array (
            'text' => 'Cuaderno Sin enviado ni la paz',
            'url' => '/envioscuaderno/sinlapazyenviados',
            'icon' => 'fas fa-exclamation-triangle',
            'can' => 'pedidos.index',
          ),
          4 => 
          array (
            'text' => 'Cuaderno Solo La Paz',
            'url' => '/envioscuaderno/sololapaz',
            'icon' => 'fas fa-globe',
            'can' => 'pedidos.index',
          ),
          5 => 
          array (
            'text' => 'La Paz Confirmados',
            'url' => '/envioscuaderno/confirmados',
            'icon' => 'fas fa-check-circle',
            'can' => 'pedidos.index',
          ),
          6 => 
          array (
            'text' => 'La Paz Pendientes',
            'url' => '/envioscuaderno/pendientes',
            'icon' => 'fas fa-hourglass-half',
            'can' => 'pedidos.index',
          ),
          7 => 
          array (
            'text' => 'Cuaderno Pendientes',
            'url' => '/envios/faltante',
            'icon' => 'fas fa-globe',
            'can' => 'pedidos.index',
          ),
          8 => 
          array (
            'text' => 'Cuaderno Listo para Enviar',
            'url' => '/envios/extra1',
            'icon' => 'fas fa-globe',
            'can' => 'pedidos.index',
          ),
        ),
      ),
      15 => 
      array (
        'text' => 'PEDIDOS',
        'icon' => 'fas fa-plane',
        'submenu' => 
        array (
          0 => 
          array (
            'text' => 'PEDIDOS',
            'url' => 'pedidos',
            'icon' => 'fas fa-plane',
            'can' => 'pedidos.index',
          ),
          1 => 
          array (
            'text' => 'DIAS DE PEDIDO',
            'url' => 'semanas',
            'icon' => 'fas fa-paper-plane',
            'can' => 'semanas.index',
          ),
          2 => 
          array (
            'text' => 'VER DIAS',
            'url' => '/orden',
            'icon' => 'fas fa-sun',
            'can' => 'orden.index',
          ),
        ),
      ),
      16 => 
      array (
        'text' => 'Solicitud y Envios de Productos',
        'icon' => 'fas fa-plane-arrival',
        'submenu' => 
        array (
          0 => 
          array (
            'text' => 'Envio de Productos',
            'url' => 'envios',
            'icon' => 'fas fa-calendar-week',
            'can' => 'envios.index',
          ),
          1 => 
          array (
            'text' => 'Historial de Envios',
            'url' => '/envios/historial',
            'icon' => 'fas fa-history',
            'can' => 'envios.historial',
          ),
          2 => 
          array (
            'text' => 'Solicitud de Productos',
            'url' => '/envios/solicitud',
            'icon' => 'fas fa-clipboard-check',
            'can' => 'envios.solicitud',
          ),
        ),
      ),
      17 => 
      array (
        'text' => 'Administrar Stock',
        'url' => 'reportestockedit',
        'icon' => 'fas fa-cubes',
        'can' => 'report.stock',
      ),
      18 => 
      array (
        'text' => 'Reporte de stock',
        'url' => 'reportestock',
        'icon' => 'fas fa-calendar-week',
        'can' => 'report.stock',
      ),
      19 => 
      array (
        'text' => 'Gestión de Almacén',
        'icon' => 'fas fa-warehouse',
        'submenu' => 
        array (
          0 => 
          array (
            'text' => 'Almacén',
            'url' => 'productos',
            'icon' => 'fas fa-store',
            'can' => 'productos.index',
          ),
          1 => 
          array (
            'text' => 'Productos en mal estado',
            'url' => '/envios/productos-mal-estado',
            'icon' => 'fas fa-exclamation-triangle',
            'can' => 'productos.index',
          ),
          2 => 
          array (
            'text' => 'Recepción a Almacén',
            'url' => '/envios/productos-almacen',
            'icon' => 'fas fa-dolly',
            'can' => 'productos.index',
          ),
        ),
      ),
      20 => 
      array (
        'text' => 'Detalles de productos',
        'icon' => 'fas fa-info',
        'submenu' => 
        array (
          0 => 
          array (
            'text' => 'Inventarios',
            'url' => 'inventarios',
            'icon' => 'fas fa-solid fa-warehouse',
            'label_color' => 'success',
            'can' => 'inventarios.index',
          ),
          1 => 
          array (
            'text' => 'Sucursales',
            'url' => 'sucursales',
            'icon' => 'fas fa-solid fa-horse',
            'label_color' => 'success',
            'can' => 'sucursales.index',
          ),
          2 => 
          array (
            'text' => 'Marcas',
            'url' => 'marcas',
            'icon' => 'fas fa-solid fa-copyright',
            'label_color' => 'success',
            'can' => 'marcas.index',
          ),
          3 => 
          array (
            'text' => 'Categorias',
            'url' => 'categorias',
            'icon' => 'fas fa-solid fa-list',
            'label_color' => 'success',
            'can' => 'categorias.index',
          ),
          4 => 
          array (
            'text' => 'Tipos',
            'url' => 'tipos',
            'icon' => 'fas fa-fw fa-file',
            'label_color' => 'success',
            'can' => 'tipos.index',
          ),
          5 => 
          array (
            'text' => 'CUPONES',
            'url' => 'cupos',
            'icon' => 'fas fa-receipt',
            'label_color' => 'success',
            'can' => 'cupos.index',
          ),
        ),
      ),
      21 => 
      array (
        'text' => 'Cajas Sucursales',
        'url' => '/cajas-sucursales',
        'icon' => 'fas fa-fw fa-share',
        'can' => 'productos.index',
      ),
      22 => 
      array (
        'text' => 'Ventas Caja',
        'icon' => 'fas fa-cash-register',
        'submenu' => 
        array (
          0 => 
          array (
            'text' => 'Ventas de Recojo',
            'url' => '/ventarecojomoderno',
            'icon' => 'fas fa-hand-holding-box',
            'can' => 'control.index',
          ),
          1 => 
          array (
            'text' => 'Ventas de Recojo Cola',
            'url' => '/ventarecojomodernocola',
            'icon' => 'fas fa-solid fa-cash-register',
            'can' => 'control.index',
          ),
          2 => 
          array (
            'text' => 'Venta Rápida Moderna',
            'url' => '/ventarapidamoderna',
            'icon' => 'fas fa-bolt',
          ),
        ),
      ),
      23 => 
      array (
        'text' => 'Ventas',
        'icon' => 'fas fa-solid fa-cash-register',
        'submenu' => 
        array (
          0 => 
          array (
            'text' => 'Venta Rápida',
            'url' => 'ventarapida',
            'icon' => 'fas fa-solid fa-cash-register',
          ),
          1 => 
          array (
            'text' => 'Cancelar Venta',
            'url' => 'cancelarventa',
            'icon' => 'fas fa-solid fa-plane-slash',
          ),
          2 => 
          array (
            'text' => 'Cancelar Venta Semana',
            'url' => '/cancelarventa/ultimasemana',
            'icon' => 'fas fa-solid fa-strikethrough',
          ),
          3 => 
          array (
            'text' => 'Venta por Sucursales',
            'url' => '/control',
            'icon' => 'fas fa-solid fa-horse',
            'can' => 'control.index',
          ),
        ),
      ),
      24 => 
      array (
        'text' => 'Ventas Promocion',
        'icon' => 'fas fa-solid fa-cash-register',
        'submenu' => 
        array (
          0 => 
          array (
            'text' => 'PROMOCIONES',
            'url' => 'promociones',
            'icon' => 'fas fa-solid fa-hourglass-start',
            'can' => 'promociones.index',
          ),
        ),
      ),
      25 => 
      array (
        'text' => 'Reporte de Ventas',
        'icon' => 'fas fa-chart-line',
        'submenu' => 
        array (
          0 => 
          array (
            'text' => 'Reporte de ventas',
            'url' => '/reporte-ventas',
            'icon' => 'fas fa-file-invoice-dollar',
            'label_color' => 'success',
            'can' => 'report.ventas',
          ),
          1 => 
          array (
            'text' => 'Ventas Canceladas',
            'url' => '/ventas-canceladas',
            'icon' => 'fas fa-ban',
            'can' => 'users.index',
          ),
          2 => 
          array (
            'text' => 'Por Día',
            'url' => '/sales-report',
            'icon' => 'fas fa-calendar-day',
            'can' => 'roles.index',
          ),
          3 => 
          array (
            'text' => 'Por Semana',
            'url' => '/sales-report/week',
            'icon' => 'fas fa-calendar-week',
            'can' => 'roles.index',
          ),
          4 => 
          array (
            'text' => 'Por Mes',
            'url' => '/sales-report/month',
            'icon' => 'fas fa-calendar-alt',
            'can' => 'roles.index',
          ),
        ),
      ),
      26 => 
      array (
        'text' => 'GENERAR REPORTES',
        'icon' => 'fas fa-fw fa-chart-pie',
        'submenu' => 
        array (
          0 => 
          array (
            'text' => 'Reporte de ventas del usuario',
            'url' => '/reporte-usuario-ventas',
            'icon' => 'fas fa-user-tag',
            'label_color' => 'info',
            'can' => 'report.user.ventas',
          ),
          1 => 
          array (
            'text' => 'Reporte de inventarios',
            'url' => '/reporte/inventario',
            'icon' => 'fas fa-boxes',
            'label_color' => 'success',
            'can' => 'report.inventario',
          ),
          2 => 
          array (
            'text' => 'Reporte de pedidos',
            'url' => '/reporte/pedidos',
            'icon' => 'fas fa-clipboard-list',
            'label_color' => 'success',
            'can' => 'reporte.pedidos',
          ),
          3 => 
          array (
            'text' => 'Reporte de pedido productos',
            'url' => '/reporte/pedidos_producto',
            'icon' => 'fas fa-truck-loading',
            'label_color' => 'success',
            'can' => 'reporte.pedidos_producto',
          ),
          4 => 
          array (
            'text' => 'Reporte Por Producto',
            'url' => 'reportes/productos',
            'icon' => 'fas fa-fw fa-share',
            'can' => 'reportes.productos.form',
          ),
        ),
      ),
    ),
    'filters' => 
    array (
      0 => 'JeroenNoten\\LaravelAdminLte\\Menu\\Filters\\GateFilter',
      1 => 'JeroenNoten\\LaravelAdminLte\\Menu\\Filters\\HrefFilter',
      2 => 'JeroenNoten\\LaravelAdminLte\\Menu\\Filters\\SearchFilter',
      3 => 'JeroenNoten\\LaravelAdminLte\\Menu\\Filters\\ActiveFilter',
      4 => 'JeroenNoten\\LaravelAdminLte\\Menu\\Filters\\ClassesFilter',
      5 => 'JeroenNoten\\LaravelAdminLte\\Menu\\Filters\\LangFilter',
      6 => 'JeroenNoten\\LaravelAdminLte\\Menu\\Filters\\DataFilter',
    ),
    'plugins' => 
    array (
      'Datatables' => 
      array (
        'active' => true,
        'files' => 
        array (
          0 => 
          array (
            'type' => 'js',
            'asset' => false,
            'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
          ),
          1 => 
          array (
            'type' => 'js',
            'asset' => false,
            'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
          ),
          2 => 
          array (
            'type' => 'css',
            'asset' => false,
            'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
          ),
        ),
      ),
      'Select2' => 
      array (
        'active' => false,
        'files' => 
        array (
          0 => 
          array (
            'type' => 'js',
            'asset' => false,
            'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
          ),
          1 => 
          array (
            'type' => 'css',
            'asset' => false,
            'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
          ),
        ),
      ),
      'Chartjs' => 
      array (
        'active' => false,
        'files' => 
        array (
          0 => 
          array (
            'type' => 'js',
            'asset' => false,
            'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
          ),
        ),
      ),
      'Sweetalert2' => 
      array (
        'active' => true,
        'files' => 
        array (
          0 => 
          array (
            'type' => 'js',
            'asset' => false,
            'location' => '//cdn.jsdelivr.net/npm/sweetalert2@11',
          ),
        ),
      ),
      'Pace' => 
      array (
        'active' => false,
        'files' => 
        array (
          0 => 
          array (
            'type' => 'css',
            'asset' => false,
            'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
          ),
          1 => 
          array (
            'type' => 'js',
            'asset' => false,
            'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
          ),
        ),
      ),
    ),
    'iframe' => 
    array (
      'default_tab' => 
      array (
        'url' => NULL,
        'title' => NULL,
      ),
      'buttons' => 
      array (
        'close' => true,
        'close_all' => true,
        'close_all_other' => true,
        'scroll_left' => true,
        'scroll_right' => true,
        'fullscreen' => true,
      ),
      'options' => 
      array (
        'loading_screen' => 1000,
        'auto_show_new_tab' => true,
        'use_navbar_items' => true,
      ),
    ),
    'livewire' => false,
  ),
  'app' => 
  array (
    'name' => 'Laravel',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://importadoramiranda.com',
    'frontend_url' => 'http://localhost:3000',
    'asset_url' => NULL,
    'timezone' => 'America/La_Paz',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'cipher' => 'AES-256-CBC',
    'key' => 'base64:z03HZykiNXeuBmHEXmAhCRf6dIZF7lJDlQCa9NaCWBw=',
    'previous_keys' => 
    array (
    ),
    'maintenance' => 
    array (
      'driver' => 'file',
      'store' => 'database',
    ),
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      15 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      16 => 'Illuminate\\Queue\\QueueServiceProvider',
      17 => 'Illuminate\\Redis\\RedisServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'App\\Providers\\AppServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Context' => 'Illuminate\\Support\\Facades\\Context',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'Date' => 'Illuminate\\Support\\Facades\\Date',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Http' => 'Illuminate\\Support\\Facades\\Http',
      'Js' => 'Illuminate\\Support\\Js',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Number' => 'Illuminate\\Support\\Number',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Process' => 'Illuminate\\Support\\Facades\\Process',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'RateLimiter' => 'Illuminate\\Support\\Facades\\RateLimiter',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schedule' => 'Illuminate\\Support\\Facades\\Schedule',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Vite' => 'Illuminate\\Support\\Facades\\Vite',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_reset_tokens',
        'expire' => 60,
        'throttle' => 60,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'cache' => 
  array (
    'default' => 'database',
    'stores' => 
    array (
      'array' => 
      array (
        'driver' => 'array',
        'serialize' => false,
      ),
      'database' => 
      array (
        'driver' => 'database',
        'connection' => NULL,
        'table' => 'cache',
        'lock_connection' => NULL,
        'lock_table' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'D:\\Trabajo Nexus\\TestImportadoraMiranda\\storage\\framework/cache/data',
        'lock_path' => 'D:\\Trabajo Nexus\\TestImportadoraMiranda\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
        'lock_connection' => 'default',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
      'octane' => 
      array (
        'driver' => 'octane',
      ),
    ),
    'prefix' => '',
  ),
  'cors' => 
  array (
    'paths' => 
    array (
      0 => 'api/*',
      1 => 'sanctum/csrf-cookie',
      2 => '*',
    ),
    'allowed_methods' => 
    array (
      0 => '*',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => 
    array (
    ),
    'max_age' => 0,
    'supports_credentials' => false,
  ),
  'crud' => 
  array (
    'stub_path' => 'default',
    'layout' => 'layouts.app',
    'model' => 
    array (
      'namespace' => 'App\\Models',
      'unwantedColumns' => 
      array (
        0 => 'id',
        1 => 'uuid',
        2 => 'ulid',
        3 => 'password',
        4 => 'email_verified_at',
        5 => 'remember_token',
        6 => 'created_at',
        7 => 'updated_at',
        8 => 'deleted_at',
      ),
    ),
    'controller' => 
    array (
      'namespace' => 'App\\Http\\Controllers',
      'apiNamespace' => 'App\\Http\\Controllers\\Api',
    ),
    'resources' => 
    array (
      'namespace' => 'App\\Http\\Resources',
    ),
    'livewire' => 
    array (
      'namespace' => 'App\\Livewire',
    ),
    'request' => 
    array (
      'namespace' => 'App\\Http\\Requests',
    ),
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'imp611',
        'prefix' => '',
        'foreign_key_constraints' => true,
        'busy_timeout' => NULL,
        'journal_mode' => NULL,
        'synchronous' => NULL,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'imp611',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
        'timezone' => '-04:00',
      ),
      'mariadb' => 
      array (
        'driver' => 'mariadb',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'imp611',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'imp611',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'search_path' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'imp611',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 
    array (
      'table' => 'migrations',
      'update_date_on_publish' => true,
    ),
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'laravel_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'username' => NULL,
        'password' => NULL,
        'port' => '6379',
        'database' => '0',
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'username' => NULL,
        'password' => NULL,
        'port' => '6379',
        'database' => '1',
      ),
    ),
  ),
  'datatables' => 
  array (
    'search' => 
    array (
      'smart' => true,
      'multi_term' => true,
      'case_insensitive' => true,
      'use_wildcards' => false,
      'starts_with' => false,
    ),
    'index_column' => 'DT_RowIndex',
    'engines' => 
    array (
      'eloquent' => 'Yajra\\DataTables\\EloquentDataTable',
      'query' => 'Yajra\\DataTables\\QueryDataTable',
      'collection' => 'Yajra\\DataTables\\CollectionDataTable',
      'resource' => 'Yajra\\DataTables\\ApiResourceDataTable',
    ),
    'builders' => 
    array (
    ),
    'nulls_last_sql' => ':column :direction NULLS LAST',
    'error' => NULL,
    'columns' => 
    array (
      'excess' => 
      array (
        0 => 'rn',
        1 => 'row_num',
      ),
      'escape' => '*',
      'raw' => 
      array (
        0 => 'action',
      ),
      'blacklist' => 
      array (
        0 => 'password',
        1 => 'remember_token',
      ),
      'whitelist' => '*',
    ),
    'json' => 
    array (
      'header' => 
      array (
      ),
      'options' => 0,
    ),
    'callback' => 
    array (
      0 => '$',
      1 => '$.',
      2 => 'function',
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'D:\\Trabajo Nexus\\TestImportadoraMiranda\\storage\\app',
        'throw' => false,
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'D:\\Trabajo Nexus\\TestImportadoraMiranda\\storage\\app/public',
        'url' => 'http://importadoramiranda.com/storage',
        'visibility' => 'public',
        'throw' => false,
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
        'endpoint' => NULL,
        'use_path_style_endpoint' => false,
        'throw' => false,
      ),
    ),
    'links' => 
    array (
      'D:\\Trabajo Nexus\\TestImportadoraMiranda\\public\\storage' => 'D:\\Trabajo Nexus\\TestImportadoraMiranda\\storage\\app/public',
    ),
  ),
  'fpdf' => 
  array (
    'orientation' => 'P',
    'unit' => 'mm',
    'size' => 'A4',
    'font_path' => NULL,
    'useVaporHeaders' => false,
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'deprecations' => 
    array (
      'channel' => NULL,
      'trace' => false,
    ),
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => 'D:\\Trabajo Nexus\\TestImportadoraMiranda\\storage\\logs/laravel.log',
        'level' => 'debug',
        'replace_placeholders' => true,
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => 'D:\\Trabajo Nexus\\TestImportadoraMiranda\\storage\\logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
        'replace_placeholders' => true,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'debug',
        'replace_placeholders' => true,
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
          'connectionString' => 'tls://:',
        ),
        'processors' => 
        array (
          0 => 'Monolog\\Processor\\PsrLogMessageProcessor',
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
        'processors' => 
        array (
          0 => 'Monolog\\Processor\\PsrLogMessageProcessor',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
        'facility' => 8,
        'replace_placeholders' => true,
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
        'replace_placeholders' => true,
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => 'D:\\Trabajo Nexus\\TestImportadoraMiranda\\storage\\logs/laravel.log',
      ),
    ),
  ),
  'mail' => 
  array (
    'default' => 'log',
    'mailers' => 
    array (
      'smtp' => 
      array (
        'transport' => 'smtp',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '2525',
        'encryption' => NULL,
        'username' => NULL,
        'password' => NULL,
        'timeout' => NULL,
        'local_domain' => 'importadoramiranda.com',
      ),
      'ses' => 
      array (
        'transport' => 'ses',
      ),
      'postmark' => 
      array (
        'transport' => 'postmark',
      ),
      'resend' => 
      array (
        'transport' => 'resend',
      ),
      'sendmail' => 
      array (
        'transport' => 'sendmail',
        'path' => '/usr/sbin/sendmail -bs -i',
      ),
      'log' => 
      array (
        'transport' => 'log',
        'channel' => NULL,
      ),
      'array' => 
      array (
        'transport' => 'array',
      ),
      'failover' => 
      array (
        'transport' => 'failover',
        'mailers' => 
        array (
          0 => 'smtp',
          1 => 'log',
        ),
      ),
      'roundrobin' => 
      array (
        'transport' => 'roundrobin',
        'mailers' => 
        array (
          0 => 'ses',
          1 => 'postmark',
        ),
      ),
    ),
    'from' => 
    array (
      'address' => 'hello@example.com',
      'name' => 'Laravel',
    ),
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'D:\\Trabajo Nexus\\TestImportadoraMiranda\\resources\\views/vendor/mail',
      ),
    ),
  ),
  'permission' => 
  array (
    'models' => 
    array (
      'permission' => 'Spatie\\Permission\\Models\\Permission',
      'role' => 'Spatie\\Permission\\Models\\Role',
    ),
    'table_names' => 
    array (
      'roles' => 'roles',
      'permissions' => 'permissions',
      'model_has_permissions' => 'model_has_permissions',
      'model_has_roles' => 'model_has_roles',
      'role_has_permissions' => 'role_has_permissions',
    ),
    'column_names' => 
    array (
      'role_pivot_key' => NULL,
      'permission_pivot_key' => NULL,
      'model_morph_key' => 'model_id',
      'team_foreign_key' => 'team_id',
    ),
    'register_permission_check_method' => true,
    'register_octane_reset_listener' => false,
    'teams' => false,
    'use_passport_client_credentials' => false,
    'display_permission_in_exception' => false,
    'display_role_in_exception' => false,
    'enable_wildcard_permission' => false,
    'cache' => 
    array (
      'expiration_time' => 
      \DateInterval::__set_state(array(
         'from_string' => true,
         'date_string' => '24 hours',
      )),
      'key' => 'spatie.permission.cache',
      'store' => 'default',
    ),
  ),
  'queue' => 
  array (
    'default' => 'database',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'connection' => NULL,
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
        'after_commit' => false,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
        'after_commit' => false,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'default',
        'suffix' => NULL,
        'region' => 'us-east-1',
        'after_commit' => false,
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
        'after_commit' => false,
      ),
    ),
    'batching' => 
    array (
      'database' => 'mysql',
      'table' => 'job_batches',
    ),
    'failed' => 
    array (
      'driver' => 'database-uuids',
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
    'resend' => 
    array (
      'key' => NULL,
    ),
    'slack' => 
    array (
      'notifications' => 
      array (
        'bot_user_oauth_token' => NULL,
        'channel' => NULL,
      ),
    ),
  ),
  'session' => 
  array (
    'driver' => 'database',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'D:\\Trabajo Nexus\\TestImportadoraMiranda\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => true,
    'same_site' => 'lax',
    'partitioned' => false,
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'reverb' => 
      array (
        'driver' => 'reverb',
        'key' => NULL,
        'secret' => NULL,
        'app_id' => NULL,
        'options' => 
        array (
          'host' => NULL,
          'port' => 443,
          'scheme' => 'https',
          'useTLS' => true,
        ),
        'client_options' => 
        array (
        ),
      ),
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => NULL,
        'secret' => NULL,
        'app_id' => NULL,
        'options' => 
        array (
          'cluster' => NULL,
          'host' => 'api-mt1.pusher.com',
          'port' => 443,
          'scheme' => 'https',
          'encrypted' => true,
          'useTLS' => true,
        ),
        'client_options' => 
        array (
        ),
      ),
      'ably' => 
      array (
        'driver' => 'ably',
        'key' => NULL,
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => '12',
      'verify' => true,
    ),
    'argon' => 
    array (
      'memory' => 65536,
      'threads' => 1,
      'time' => 4,
      'verify' => true,
    ),
    'rehash_on_login' => true,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'D:\\Trabajo Nexus\\TestImportadoraMiranda\\resources\\views',
    ),
    'compiled' => 'D:\\Trabajo Nexus\\TestImportadoraMiranda\\storage\\framework\\views',
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'public_path' => NULL,
    'convert_entities' => true,
    'options' => 
    array (
      'font_dir' => 'D:\\Trabajo Nexus\\TestImportadoraMiranda\\storage\\fonts',
      'font_cache' => 'D:\\Trabajo Nexus\\TestImportadoraMiranda\\storage\\fonts',
      'temp_dir' => 'C:\\Users\\Ronald\\AppData\\Local\\Temp',
      'chroot' => 'D:\\Trabajo Nexus\\TestImportadoraMiranda',
      'allowed_protocols' => 
      array (
        'file://' => 
        array (
          'rules' => 
          array (
          ),
        ),
        'http://' => 
        array (
          'rules' => 
          array (
          ),
        ),
        'https://' => 
        array (
          'rules' => 
          array (
          ),
        ),
      ),
      'artifactPathValidation' => NULL,
      'log_output_file' => NULL,
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_paper_orientation' => 'portrait',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => false,
      'allowed_remote_hosts' => NULL,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => true,
    ),
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
