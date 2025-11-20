<?php $__env->startSection('title', 'ventas'); ?>
<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-4">Venta de productos de <?php echo e($sucur->nombre); ?></h1>
        <div id="clock" class="text-right"></div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div id="lista-cursos" class="container">
        <div class="d-flex flex-wrap justify-content-end">
            <!-- Carrito -->
            <a class="btn btn-info ml-2 mb-2 d-flex align-items-center" href="#" id="mostrar-carrito" data-toggle="modal"
                data-target="#carritoModal">
                <i class="fas fa-shopping-cart mr-2"></i> Carrito Vendedor (<span id="carrito-contador">0</span>)
            </a>
        </div>
        <br>
        <br>
        <!-- Buscador -->
        <div class="mb-3">
            <input type="text" id="search" class="form-control" placeholder="Buscar producto..." />
        </div>
        <div class="row" id="product-list">
            <!-- Aquí se cargarán los productos dinámicamente con AJAX -->
        </div>
        <!-- Paginación -->
        <div id="pagination-links" class="pagination-gutter">
            <!-- Los links de paginación se cargarán aquí dinámicamente -->
        </div>
        
        <form id="venta-form" method="POST" action="<?php echo e(route('control.fin')); ?>" target="_blank">
            <?php echo csrf_field(); ?>
            <input type="hidden" id="sucursal_id" value="<?php echo e(auth()->user()->sucursal_id); ?>">
            <input type="hidden" name="venta_token" value="<?php echo e(session('venta_token')); ?>">

            <?php echo $__env->make('control.partials.cart-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </form>

        <?php echo $__env->make('control.partials.qr-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('control.partials.quantity-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <ul id="pagination" class="pagination justify-content-center"></ul>
    </div> <!-- .container -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/pro.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <?php echo $__env->make('js.pro', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Trabajo Nexus\TestImportadoraMiranda\resources\views/control/pro.blade.php ENDPATH**/ ?>