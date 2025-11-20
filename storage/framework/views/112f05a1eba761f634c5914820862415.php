
<?php $__env->startSection('title', 'Ver Registro'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-body">
            <h3>Registro #<?php echo e($registro->id); ?></h3>
            <p><strong>Celular:</strong> <?php echo e($registro->celular); ?></p>
            <p><strong>Persona:</strong> <?php echo e($registro->persona); ?></p>
            <p><strong>Departamento:</strong> <?php echo e($registro->departamento); ?></p>
            <p><strong>Producto:</strong> <?php echo e($registro->producto->nombre ?? ''); ?></p>
            <p><strong>Estado:</strong> <?php echo e(ucfirst($registro->estado)); ?></p>
            <p><strong>Descripción del Problema:</strong> <?php echo e($registro->descripcion_problema); ?></p>
            <p><strong>Fecha Registro:</strong> <?php echo e($registro->fecha_inscripcion); ?></p>
            <p><strong>Fecha Cambio de Estado:</strong> <?php echo e($registro->fecha_cambio_estado ?? '-'); ?></p>
            <a href="<?php echo e(route('prodregistromalestado.index')); ?>" class="btn btn-secondary">Volver</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/registros/show.blade.php ENDPATH**/ ?>