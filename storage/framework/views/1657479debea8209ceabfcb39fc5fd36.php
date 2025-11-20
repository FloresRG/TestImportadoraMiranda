<?php $__env->startSection('title', "Productos - {$sucursal->nombre}"); ?>
<?php $__env->startSection('content_header'); ?>
<div class="d-flex flex-column align-items-end mb-3">
    <h1 class="fw-bold" style="font-size: 1.8rem; color: #1e293b; align-self: flex-start;">
 <span class="text-primary"><?php echo e($sucursal->nombre); ?></span>
    </h1>
   <div class="position-relative mt-2" x-data="{ carrito: $store.carrito }">
    <div class="d-flex align-items-center text-white rounded-pill px-4 py-2 shadow-sm"
        style="background: linear-gradient(135deg, #cc9efd, #3b78d8); min-width: 140px;">
        <i class="fas fa-shopping-cart me-2" style="font-size: 1.25rem; opacity: 0.9;"></i>
        <span class="fw-extrabold" style="font-size: 1.5rem; color: white; text-shadow: 0 1px 2px rgba(0,0,0,0.3);">
            <span x-text="carrito.totalItems || 0"></span>
        </span>
        <span class="ms-2" style="font-size: 0.85rem; opacity: 0.85; letter-spacing: 0.5px;">
            Productos
        </span>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid" x-data="productosApp(<?php echo e($sucursalId); ?>)">
    <?php echo $__env->make('ventas.partials.search-box', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div id="productos-list" class="row" x-cloak>
        
    </div>

    <div class="d-flex justify-content-center mt-4" id="pagination-links"></div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.10/dist/cdn.min.js" defer></script>
<script src="<?php echo e(asset('js/ventas/productos-alpine.js')); ?>"></script>
<style>
    .cursor-pointer { cursor: pointer; }
    .text-truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    [x-cloak] { display: none !important; }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Trabajo Nexus\TestImportadoraMiranda\resources\views/ventas/productos.blade.php ENDPATH**/ ?>