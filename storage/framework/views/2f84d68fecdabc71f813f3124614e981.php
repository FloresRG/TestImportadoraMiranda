<?php $__env->startSection('title', 'Panel de Administración'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Bienvenido al Panel de Administración</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title"><?php echo e(__('Show')); ?> Semana</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="<?php echo e(route('semanas.index')); ?>"> <?php echo e(__('Back')); ?></a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    <?php echo e($semana->nombre); ?>

                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha:</strong>
                                    <?php echo e($semana->fecha); ?>

                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/semana/show.blade.php ENDPATH**/ ?>