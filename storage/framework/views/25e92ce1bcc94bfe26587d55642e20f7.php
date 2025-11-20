

<?php $__env->startSection('title', 'Detalles del Proveedor'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-user-tie mr-2"></i>Detalles del Proveedor</h1>
        <div>
            <a href="<?php echo e(route('proveedores.edit', $proveedor->id)); ?>" class="btn btn-warning mr-2">
                <i class="fas fa-edit mr-1"></i>Editar
            </a>
            <a href="<?php echo e(route('proveedores.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i>Volver
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-7">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Información del Proveedor</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php $__currentLoopData = [ 
                            'Nombre del Proveedor' => $proveedor->nombre,
                            'Código de Factura' => $proveedor->codigo_factura,
                            'Fecha de Registro' => date('d/m/Y', strtotime($proveedor->fecha_registro)),
                        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6 mb-3">
                                <div class="info-box bg-light shadow-sm rounded p-3">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-muted"><?php echo e($label); ?></span>
                                        <span class="info-box-number font-weight-bold"><?php echo e($value); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($proveedor->foto_factura): ?>
                            <div class="col-md-6 mb-3">
                                <div class="info-box bg-light shadow-sm rounded p-3">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-muted">Factura</span>
                                        <a href="<?php echo e(Storage::url($proveedor->foto_factura)); ?>" target="_blank" class="btn btn-info btn-sm">
                                            Ver Factura
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-md-6 mb-3">
                            <div class="info-box bg-light shadow-sm rounded p-3">
                                <div class="info-box-content">
                                    <span class="info-box-text text-muted">Estado</span>
                                    <span class="info-box-number">
                                        <span class="badge badge-<?php echo e($proveedor->estado == 'Pagado' ? 'success' : 'warning'); ?> p-2">
                                            <i class="fas <?php echo e($proveedor->estado == 'Pagado' ? 'fa-check-circle' : 'fa-clock'); ?> mr-1"></i>
                                            <?php echo e($proveedor->estado == 'Pagado' ? 'Pagado' : 'Saldo pendiente'); ?>

                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-lg mt-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Información Financiera</h3>
                </div>
                <div class="card-body">
                    <?php
                        $pagosTotales = $proveedor->pagos()->sum('monto_pago') + $proveedor->pago_inicial;
                        $saldoPendiente = max(0, $proveedor->deuda_total - $pagosTotales);
                        $porcentajePagado = $proveedor->deuda_total > 0 ? round(($pagosTotales / $proveedor->deuda_total) * 100) : 0;
                    ?>

                    <div class="row">
                        <?php $__currentLoopData = [ 
                            'Deuda Total' => $proveedor->deuda_total,
                            'Pago Inicial' => $proveedor->pago_inicial,
                            'Total Pagado' => $pagosTotales,
                            'Saldo Pendiente' => $saldoPendiente
                        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6 mb-3">
                                <div class="info-box bg-light shadow-sm rounded p-3">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-muted"><?php echo e($label); ?></span>
                                        <span class="info-box-number font-weight-bold">$<?php echo e(number_format($value, 2)); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <h5 class="mt-3 mb-2">Progreso de Pago</h5>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-success progress-bar-striped" role="progressbar" style="width: <?php echo e($porcentajePagado); ?>%" aria-valuenow="<?php echo e($porcentajePagado); ?>" aria-valuemin="0" aria-valuemax="100">
                            <?php echo e($porcentajePagado); ?>%
                        </div>
                    </div>

                    <?php if($saldoPendiente > 0): ?>
                        <div class="text-center mt-4">
                            <a href="<?php echo e(route('pagos.create', ['proveedor_id' => $proveedor->id])); ?>" class="btn btn-success">
                                <i class="fas fa-money-bill-wave mr-1"></i>Registrar Nuevo Pago
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/proveedores/show.blade.php ENDPATH**/ ?>