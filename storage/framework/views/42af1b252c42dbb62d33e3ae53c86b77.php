

<?php $__env->startSection('title', 'Editar Solicitud'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Editar Solicitud</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <form action="<?php echo e(route('solicitudes.update', $solicitude->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?php echo e($solicitude->nombre); ?>" required>
            </div>

            <div class="form-group">
                <label>CI</label>
                <input type="text" name="ci" class="form-control" value="<?php echo e($solicitude->ci); ?>" required>
            </div>

            <div class="form-group">
                <label>Celular</label>
                <input type="text" name="celular" class="form-control" value="<?php echo e($solicitude->celular); ?>" required>
            </div>

            <div class="form-group">
                <label>CV en PDF</label>
                <input type="file" name="cv_pdf" accept="application/pdf" class="form-control">
                <?php if($solicitude->cv_pdf): ?>
                    <p>Archivo actual: <a href="<?php echo e(asset('storage/' . $solicitude->cv_pdf)); ?>" target="_blank">Ver CV</a></p>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Actualizar</button>
            <a href="<?php echo e(route('solicitudes.index')); ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/solicitudes/edit.blade.php ENDPATH**/ ?>