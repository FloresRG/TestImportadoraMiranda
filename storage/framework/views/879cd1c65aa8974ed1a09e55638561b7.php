<nav class="main-header navbar custom-navbar
   <?php echo e(config('adminlte.classes_topnav_nav', 'navbar-expand')); ?>

   <?php echo e(config('adminlte.classes_topnav', 'navbar-white navbar-light')); ?>">

    
    <ul class="navbar-nav">
        <?php echo $__env->make('adminlte::partials.navbar.menu-item-left-sidebar-toggler', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->renderEach('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item'); ?>
        <?php echo $__env->yieldContent('content_top_nav_left'); ?>
    </ul>

    
    <ul class="navbar-nav ml-auto">
        <?php echo $__env->yieldContent('content_top_nav_right'); ?>
        <?php echo $__env->renderEach('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-right'), 'item'); ?>
        <?php if(config('adminlte.layout_dark_mode')): ?>
            <li class="nav-item">
                <?php if (isset($component)) { $__componentOriginalea438dd121312d75fa7ccadbde4a21ec = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalea438dd121312d75fa7ccadbde4a21ec = $attributes; } ?>
<?php $component = JeroenNoten\LaravelAdminLte\View\Components\Layout\NavbarDarkmodeWidget::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('adminlte-navbar-darkmode-widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\JeroenNoten\LaravelAdminLte\View\Components\Layout\NavbarDarkmodeWidget::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalea438dd121312d75fa7ccadbde4a21ec)): ?>
<?php $attributes = $__attributesOriginalea438dd121312d75fa7ccadbde4a21ec; ?>
<?php unset($__attributesOriginalea438dd121312d75fa7ccadbde4a21ec); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalea438dd121312d75fa7ccadbde4a21ec)): ?>
<?php $component = $__componentOriginalea438dd121312d75fa7ccadbde4a21ec; ?>
<?php unset($__componentOriginalea438dd121312d75fa7ccadbde4a21ec); ?>
<?php endif; ?>
            </li>
        <?php endif; ?>
        <?php if(Auth::user()): ?>
            <?php if(config('adminlte.usermenu_enabled')): ?>
                <?php echo $__env->make('adminlte::partials.navbar.menu-item-dropdown-user-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('adminlte::partials.navbar.menu-item-logout-link', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        <?php endif; ?>
        <?php if(config('adminlte.right_sidebar')): ?>
            <?php echo $__env->make('adminlte::partials.navbar.menu-item-right-sidebar-toggler', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
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
<?php /**PATH D:\Trabajo Nexus\TestImportadoraMiranda\resources\views/vendor/adminlte/partials/navbar/navbar.blade.php ENDPATH**/ ?>