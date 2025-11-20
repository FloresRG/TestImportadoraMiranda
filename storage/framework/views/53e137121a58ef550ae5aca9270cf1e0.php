

<?php $__env->startSection('title', 'Auditoría de Stock'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="text-center">Auditoría de Movimientos de Stock</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-body">
            <table id="stock-log-table" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Producto</th>
                        <th>Sucursal</th>
                        <th>Valor Anterior</th>
                        <th>Valor Nuevo</th>
                        <th>Usuario</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
$(function () {
    $('#stock-log-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '<?php echo e(route("report.stocklog.data")); ?>',
        columns: [
            { data: 'created_at', name: 'created_at' },
            { data: 'producto', name: 'producto' },
            { data: 'sucursal', name: 'sucursal' },
            { data: 'valor_anterior', name: 'valor_anterior' },
            { data: 'valor_nuevo', name: 'valor_nuevo' },
            { data: 'usuario', name: 'usuario' },
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/productos/stocklog.blade.php ENDPATH**/ ?>