<!-- resources/views/informes/pagos-diarios.blade.php -->


<?php $__env->startSection('title', 'Pagos Diarios'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-calendar-day mr-2"></i>Pagos Diarios</h1>
        <a href="<?php echo e(route('informes.index')); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i>Volver
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <form action="<?php echo e(route('informes.pagos-diarios')); ?>" method="GET" class="form-inline">
            <div class="form-group mr-3">
                <label for="fecha" class="mr-2">Seleccionar fecha:</label>
                <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo e($fecha); ?>">
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search mr-1"></i>Consultar
            </button>
        </form>
    </div>
    <div class="card-body">
        <h3 class="text-center mb-4">Informe de Pagos: <?php echo e(date('d/m/Y', strtotime($fecha))); ?></h3>
        
        <?php if($pagos->isEmpty()): ?>
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle mr-2"></i>No hay pagos registrados para esta fecha.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Proveedor</th>
                            <th>Monto</th>
                            <th>Código Factura</th>
                            <th>Hora de Registro</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $pagos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pago): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($pago->proveedor->nombre); ?></td>
                            <td>$<?php echo e(number_format($pago->monto_pago, 2)); ?></td>
                            <td><?php echo e($pago->proveedor->codigo_factura); ?></td>
                            <td><?php echo e($pago->created_at->format('H:i:s')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Total</th>
                            <th colspan="3">$<?php echo e(number_format($total, 2)); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/informes/pagos-diarios.blade.php ENDPATH**/ ?>