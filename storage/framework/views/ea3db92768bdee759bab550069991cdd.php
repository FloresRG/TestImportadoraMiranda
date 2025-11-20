

<?php $__env->startSection('title', 'Panel de Administración'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Bienvenido al Panel de Administración</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                <?php echo e(__('Semanas')); ?>

                            </span>

                            <div class="float-right">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('semanas.create')): ?>
                                    
                                    <a href="<?php echo e(route('semanas.create')); ?>" class="btn btn-primary btn-sm float-right"
                                        data-placement="left">
                                        <?php echo e(__('Create New')); ?>

                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php if($message = Session::get('success')): ?>
                        <div class="alert alert-success m-4">
                            <p><?php echo e($message); ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                        <th>Nombre</th>
                                        <th>Fecha</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $semanas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $semana): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(++$i); ?></td>

                                            <td><?php echo e($semana->nombre); ?></td>
                                            <td><?php echo e($semana->fecha); ?></td>

                                            <td>
                                                <form action="<?php echo e(route('semanas.destroy', $semana->id)); ?>" method="POST">
                                                    <a class="btn btn-sm btn-primary"
                                                        href="<?php echo e(route('semanas.show', $semana->id)); ?>">
                                                        <i class="fa fa-fw fa-eye"></i> <?php echo e(__('Show')); ?>

                                                    </a>

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('semanas.edit')): ?>
                                                        
                                                        <a class="btn btn-sm btn-success"
                                                            href="<?php echo e(route('semanas.edit', $semana->id)); ?>">
                                                            <i class="fa fa-fw fa-edit"></i> <?php echo e(__('Edit')); ?>

                                                        </a>
                                                    <?php endif; ?>

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('semanas.destroy')): ?>
                                                        
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;">
                                                            <i class="fa fa-fw fa-trash"></i> <?php echo e(__('Delete')); ?>

                                                        </button>
                                                    <?php endif; ?>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php echo $semanas->withQueryString()->links(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/semana/index.blade.php ENDPATH**/ ?>