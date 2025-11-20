

<?php $__env->startSection('template_title'); ?>
    <?php echo e($cupo->name ?? __('Show') . " " . __('Cupo')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title"><?php echo e(__('Show')); ?> Cupo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="<?php echo e(route('cupos.index')); ?>"> <?php echo e(__('Back')); ?></a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="form-group mb-2 mb20">
                            <strong><?php echo e(__('Codigo:')); ?></strong>
                            <?php echo e($cupo->codigo); ?>

                        </div>

                        <div class="form-group mb-2 mb20">
                            <strong><?php echo e(__('Porcentaje:')); ?></strong>
                            <?php echo e($cupo->porcentaje); ?>%
                        </div>

                        <div class="form-group mb-2 mb20">
                            <strong><?php echo e(__('Estado:')); ?></strong>
                            <span class="<?php echo e($cupo->estado == 'Inactivo' ? 'text-danger' : 'text-success'); ?>">
                                <?php echo e($cupo->estado); ?>

                            </span>
                        </div>

                        <div class="form-group mb-2 mb20">
                            <strong><?php echo e(__('Fecha de Inicio:')); ?></strong>
                            <?php echo e($cupo->fecha_inicio ? $cupo->fecha_inicio->format('d/m/Y H:i') : 'N/A'); ?>

                        </div>

                        <div class="form-group mb-2 mb20">
                            <strong><?php echo e(__('Fecha de Fin:')); ?></strong>
                            <?php echo e($cupo->fecha_fin ? $cupo->fecha_fin->format('d/m/Y H:i') : 'N/A'); ?>

                        </div>

                        <div class="form-group mb-2 mb20">
                            <strong><?php echo e(__('Usuario:')); ?></strong>
                            <?php echo e($cupo->user->name ?? 'Usuario no asignado'); ?> <!-- Asumiendo que tienes una relación con usuario -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/cupo/show.blade.php ENDPATH**/ ?>