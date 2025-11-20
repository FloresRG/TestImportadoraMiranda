

<?php $__env->startSection('title', 'Nueva Solicitud'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Nueva Solicitud de Trabajo</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <form action="<?php echo e(route('solicitudes.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="form-group">
                <label>CI</label>
                <input type="text" name="ci" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Celular</label>
                <input type="text" name="celular" class="form-control" required>
            </div>

            <div class="form-group">
                <label>CV en PDF</label>
                <input type="file" name="cv_pdf" accept="application/pdf" class="form-control">
            </div>

            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
            <a href="<?php echo e(route('solicitudes.index')); ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/solicitudes/create.blade.php ENDPATH**/ ?>