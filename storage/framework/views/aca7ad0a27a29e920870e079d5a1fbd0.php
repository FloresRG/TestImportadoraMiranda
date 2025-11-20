<!-- resources/views/informes/proveedores-pagados.blade.php -->


<?php $__env->startSection('title', 'Proveedores Pagados'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-check-circle mr-2"></i>Proveedores Pagados</h1>
        <a href="<?php echo e(route('informes.index')); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i>Volver
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-body">
        <h3 class="text-center mb-4">Informe de Proveedores con Pago Completo</h3>
        
        <?php if($proveedores->isEmpty()): ?>
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle mr-2"></i>No hay proveedores con pagos completados.
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
                            <th>Último Pago</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proveedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($proveedor->nombre); ?></td>
                            <td><?php echo e($proveedor->codigo_factura); ?></td>
                            <td><?php echo e(date('d/m/Y', strtotime($proveedor->fecha_registro))); ?></td>
                            <td>$<?php echo e(number_format($proveedor->deuda_total, 2)); ?></td>
                            <td>
                                <?php if($proveedor->pagos->count() > 0): ?>
                                    <?php echo e($proveedor->pagos->sortByDesc('fecha_pago')->first()->fecha_pago->format('d/m/Y')); ?>

                                <?php else: ?>
                                    <?php echo e(date('d/m/Y', strtotime($proveedor->fecha_registro))); ?> (Pago inicial)
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('proveedores.show', $proveedor->id)); ?>" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye mr-1"></i>Ver detalles
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3">Total de pagos completados</th>
                            <th>$<?php echo e(number_format($totalPagado, 2)); ?></th>
                            <th colspan="2"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/informes/proveedores-pagados.blade.php ENDPATH**/ ?>