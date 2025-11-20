<!-- resources/views/informes/index.blade.php -->


<?php $__env->startSection('title', 'Informes de Pagos'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1><i class="fas fa-chart-bar mr-2"></i>Informes de Pagos</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <!-- Informe Diario -->
    <div class="col-md-6 col-lg-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>Diario</h3>
                <p>Pagos por día</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-day"></i>
            </div>
            <a href="<?php echo e(route('informes.pagos-diarios')); ?>" class="small-box-footer">
                Ver informe <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    
    <!-- Informe Mensual -->
    <div class="col-md-6 col-lg-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>Mensual</h3>
                <p>Pagos por mes</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <a href="<?php echo e(route('informes.pagos-mensuales')); ?>" class="small-box-footer">
                Ver informe <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    
    <!-- Proveedores Pagados -->
    <div class="col-md-6 col-lg-3">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>Pagados</h3>
                <p>Proveedores sin saldo</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <a href="<?php echo e(route('informes.proveedores-pagados')); ?>" class="small-box-footer">
                Ver informe <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    
    <!-- Proveedores Pendientes -->
    <div class="col-md-6 col-lg-3">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>Pendientes</h3>
                <p>Proveedores con saldo</p>
            </div>
            <div class="icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <a href="<?php echo e(route('informes.proveedores-pendientes')); ?>" class="small-box-footer">
                Ver informe <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/informes/index.blade.php ENDPATH**/ ?>