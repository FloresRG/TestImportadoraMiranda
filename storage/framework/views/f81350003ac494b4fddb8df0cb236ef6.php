<!-- resources/views/informes/proveedores-pendientes.blade.php -->


<?php $__env->startSection('title', 'Proveedores con Saldo Pendiente'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-exclamation-circle mr-2"></i>Proveedores con Saldo Pendiente</h1>
        <a href="<?php echo e(route('informes.index')); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i>Volver
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-body">
        <h3 class="text-center mb-4">Informe de Proveedores con Saldo Pendiente</h3>
        
        <?php if($proveedores->isEmpty()): ?>
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle mr-2"></i>No hay proveedores con saldo pendiente.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Proveedor</th>
                            <th>Código Factura</th>
                            <th>Fecha Registro</th>
                            <th>Deuda Total</th>
                            <th>Saldo Pendiente</th>
                            <th>% Pagado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proveedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $pagado = $proveedor->deuda_total - $proveedor->saldo_pendiente;
                            $porcentaje = $proveedor->deuda_total > 0 ? round(($pagado / $proveedor->deuda_total) * 100) : 0;
                        ?>
                        <tr>
                            <td><?php echo e($proveedor->nombre); ?></td>
                            <td><?php echo e($proveedor->codigo_factura); ?></td>
                            <td><?php echo e(date('d/m/Y', strtotime($proveedor->fecha_registro))); ?></td>
                            <td>$<?php echo e(number_format($proveedor->deuda_total, 2)); ?></td>
                            <td>$<?php echo e(number_format($proveedor->saldo_pendiente, 2)); ?></td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo e($porcentaje); ?>%">
                                        <?php echo e($porcentaje); ?>%
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?php echo e(route('proveedores.show', $proveedor->id)); ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('pagos.create', ['proveedor_id' => $proveedor->id])); ?>" class="btn btn-sm btn-success">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4">Total pendiente de pago</th>
                            <th>$<?php echo e(number_format($totalPendiente, 2)); ?></th>
                            <th colspan="2"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/informes/proveedores-pendientes.blade.php ENDPATH**/ ?>