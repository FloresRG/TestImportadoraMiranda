

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Generar Reporte de Producto</h2>

    <form action="<?php echo e(route('reportes.productos.generar')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label for="id_producto">Seleccionar Producto</label>
            <!-- Aplicamos SlimSelect al select -->
            <select name="id_producto" id="id_producto" class="form-control" required>
                <option value="">Seleccione un producto</option>
                <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($producto->id); ?>"><?php echo e($producto->nombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="fecha_fin">Fecha de Fin</label>
            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Generar Reporte</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <!-- Incluir SlimSelect CSS & JS -->
    <script src="https://unpkg.com/slim-select@latest/dist/slimselect.min.js"></script>
    <link href="https://unpkg.com/slim-select@latest/dist/slimselect.css" rel="stylesheet">
    
    <script>
        $(document).ready(function() {
            // Inicializamos SlimSelect para el select de producto
            new SlimSelect({
                select: '#id_producto' // Asegúrate de que el ID coincida con el ID de tu select
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/reporte/productos.blade.php ENDPATH**/ ?>