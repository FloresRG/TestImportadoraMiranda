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
                            <span class="card-title"><?php echo e(__('Show')); ?> Pedido</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="<?php echo e(route('pedidos.index')); ?>"> <?php echo e(__('Back')); ?></a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    <?php echo e($pedido->nombre); ?>

                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Ci:</strong>
                                    <?php echo e($pedido->ci); ?>

                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Celular:</strong>
                                    <?php echo e($pedido->celular); ?>

                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Destino:</strong>
                                    <?php echo e($pedido->destino); ?>

                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Direccion:</strong>
                                    <?php echo e($pedido->direccion); ?>

                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Estado:</strong>
                                    <?php echo e($pedido->estado); ?>

                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Cantidad Productos:</strong>
                                    <?php echo e($pedido->cantidad_productos); ?>

                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Detalle:</strong>
                                    <?php echo e($pedido->detalle); ?>

                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Productos:</strong>
                                    <?php echo e($pedido->productos); ?>

                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Monto Deposito:</strong>
                                    <?php echo e($pedido->monto_deposito); ?>

                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Monto Enviado Pagado:</strong>
                                    <?php echo e($pedido->monto_enviado_pagado); ?>

                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha:</strong>
                                    <?php echo e($pedido->fecha); ?>

                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Semana:</strong>
                                    <?php echo e($pedido->id_semana); ?>

                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/pedido/show.blade.php ENDPATH**/ ?>