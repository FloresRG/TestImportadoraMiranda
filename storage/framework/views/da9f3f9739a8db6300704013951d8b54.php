


<?php $__env->startSection('title', 'Panel de Administración'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<h1>Selecciona un mes para descargar el reporte de pedidos</h1>
    <form action="<?php echo e(route('reporte.descargar')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <label for="mes">Mes:</label>
        <input type="month" name="mes" id="mes" required>
        <button type="submit">Descargar Reporte de Mes</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/reporte/index.blade.php ENDPATH**/ ?>