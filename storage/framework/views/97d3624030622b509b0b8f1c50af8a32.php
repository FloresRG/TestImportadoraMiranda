<?php $__env->startSection('title', 'ventas'); ?>
<?php $__env->startSection('content_header'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-4">Venta de productos de <?php echo e($sucur->nombre); ?></h1>
    <div class="d-flex align-items-center">
        <div id="clock" class="text-right mr-3"></div>
        <div class="position-relative" x-data="{ carrito: $store.carrito }">
            <a class="btn btn-info d-flex align-items-center" href="#" id="mostrar-carrito" data-toggle="modal" data-target="#carritoModal">
                <i class="fas fa-shopping-cart mr-2"></i> Carrito (<span x-text="carrito.totalItems || 0"></span>)
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid" x-data="productosApp(<?php echo e($id); ?>)">
        <?php echo $__env->make('ventas.partials.search-box', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div id="productos-list" class="row" x-cloak>
            
        </div>

        <div class="d-flex justify-content-center mt-4" id="pagination-links"></div>
    </div>

    
    <form id="venta-form" method="POST" action="<?php echo e(route('control.fin')); ?>" target="_blank">
        <?php echo csrf_field(); ?>
        <input type="hidden" id="sucursal_id" value="<?php echo e(auth()->user()->sucursal_id); ?>">
        <input type="hidden" name="venta_token" value="<?php echo e(session('venta_token')); ?>">

        <?php echo $__env->make('control.partials.cart-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </form>

    <?php echo $__env->make('control.partials.qr-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('control.partials.quantity-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/pro.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.10/dist/cdn.min.js" defer></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <?php echo $__env->make('js.pro-alpine', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\TESTIMPORTADORA\TestImportadoraMiranda\resources\views/control/pro.blade.php ENDPATH**/ ?>