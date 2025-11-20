

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h2>Reporte de Producto: <?php echo e($producto->nombre); ?></h2>

        <p><strong>Fechas:</strong> <?php echo e($fecha_inicio->format('d/m/Y')); ?> - <?php echo e($fecha_fin->format('d/m/Y')); ?></p>

        <div class="container">
            <h1>Cantidad Inicial: <?php echo e(number_format($producto->precio_descuento)); ?> Uni.</h1>
        
            <h3>Vendidas: 
                <?php echo e(number_format($producto->precio_descuento - ($totalGeneral['cantidad'] + $totalPedidosPrecio))); ?> Uni.
            </h3>
        
            <h3>Restantes: 
                <?php echo e(number_format($producto->precio_descuento-($producto->precio_descuento - ($totalGeneral['cantidad'] + $totalPedidosPrecio)))); ?> Uni.
            </h3>
        </div>
        
         <!-- Total General -->
        <div class="alert alert-info">
            <strong>Total General:</strong><br>
            Total Vendido: <span class="badge badge-primary"><?php echo e(number_format($totalGeneral['total'], 2)); ?> Bs</span><br>
            Total Unidades Vendidas: <span class="badge badge-secondary"><?php echo e($totalGeneral['cantidad']); ?> unidades</span><br>
            Total por QR: <span class="badge badge-success"><?php echo e(number_format($totalGeneral['qr'], 2)); ?> Bs</span><br>
            Total por Efectivo: <span class="badge badge-warning"><?php echo e(number_format($totalGeneral['efectivo'], 2)); ?>

                Bs</span><br>
            Total de Pedidos: <span class="badge badge-info"><?php echo e($totalPedidos); ?> pedidos</span>
            Total de Pedidos Dinero : <span class="badge badge-info"><?php echo e($totalPedidosPrecio); ?> Bs</span>

        </div>

        <!-- Ventas por sucursal -->
        <div class="row">
            <?php $__currentLoopData = $ventasPorSucursal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sucursalId => $totales): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="alert alert-secondary">
                        <strong>Sucursal <?php echo e($sucursalId); ?></strong><br>
                        Total Vendido: <span class="badge badge-primary"><?php echo e(number_format($totales['total'], 2)); ?>

                            Bs</span><br>
                        Cantidad Vendida: <span class="badge badge-secondary"><?php echo e($totales['cantidad']); ?>

                            unidades</span><br>
                        QR: <span class="badge badge-success"><?php echo e(number_format($totales['qr'], 2)); ?> Bs</span><br>
                        Efectivo: <span class="badge badge-warning"><?php echo e(number_format($totales['efectivo'], 2)); ?>

                            Bs</span><br>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="alert alert-secondary">
                    <strong>PEDIDOS TIKTOK </strong><br>
                    Total Vendido: <span class="badge badge-primary"><?php echo e($totalPedidosPrecio); ?>

                        Bs</span><br>
                    Cantidad Vendida: <span class="badge badge-secondary"><?php echo e($totalPedidos); ?> unidades</span><br>
                </div>
            </div>
        </div>

        <!-- Tabla de Ventas -->
        <h3>Ventas Relacionadas</h3>
        <table id="ventasTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha de Venta</th>
                    <th>Cliente</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                    <th>Sucursal</th>
                    <th>Tipo de Pago</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <!-- Tabla de Pedidos -->
        <h3>Pedidos Relacionados</h3>
        <table id="pedidosTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha de Pedido</th>
                    <th>ID Pedido</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

<?php $__env->startSection('js'); ?>
    <!-- Cargar DataTables con AJAX -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            var idProducto = '<?php echo e($producto->id); ?>';
            var fechaInicio = '<?php echo e($fecha_inicio->toDateString()); ?>';
            var fechaFin = '<?php echo e($fecha_fin->toDateString()); ?>';

            // Imprimir en consola los valores de idProducto, fechaInicio y fechaFin
            console.log("Producto ID: " + idProducto);
            console.log("Fecha Inicio: " + fechaInicio);
            console.log("Fecha Fin: " + fechaFin);

            // DataTable para Ventas
            $('#ventasTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?php echo e(route('reportes.productos.ventas.data')); ?>",
                    data: function(d) {
                        d.id_producto = idProducto;
                        d.fecha_inicio = fechaInicio;
                        d.fecha_fin = fechaFin;

                        // Imprimir los datos que se están enviando con la solicitud AJAX
                        console.log("Datos enviados para Ventas:", d);
                    },
                    error: function(xhr, status, error) {
                        // Imprimir el error si algo sale mal
                        console.log("Error al obtener datos de Ventas:", error);
                    }
                },
                columns: [{
                        data: 'fecha',
                        name: 'fecha'
                    },
                    {
                        data: 'cliente',
                        name: 'cliente'
                    },
                    {
                        data: 'cantidad',
                        name: 'cantidad'
                    },
                    {
                        data: 'precio_unitario',
                        name: 'precio_unitario'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    },
                    {
                        data: 'sucursal',
                        name: 'sucursal'
                    },
                    {
                        data: 'tipo_pago',
                        name: 'tipo_pago'
                    }
                ],
                drawCallback: function(settings) {
                    // Imprimir respuesta de DataTables (cuando se termina de dibujar la tabla)
                    console.log("Datos de ventas cargados:", settings);
                }
            });

            // DataTable para Pedidos
            $('#pedidosTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?php echo e(route('reportes.productos.pedidos.data')); ?>",
                    data: function(d) {
                        d.id_producto = idProducto;
                        d.fecha_inicio = fechaInicio;
                        d.fecha_fin = fechaFin;

                        // Imprimir los datos que se están enviando con la solicitud AJAX
                        console.log("Datos enviados para Pedidos:", d);
                    },
                    error: function(xhr, status, error) {
                        // Imprimir el error si algo sale mal
                        console.log("Error al obtener datos de Pedidos:", error);
                    }
                },
                columns: [{
                        data: 'fecha',
                        name: 'fecha'
                    },
                    {
                        data: 'id_pedido',
                        name: 'id_pedido'
                    },
                    {
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'cantidad',
                        name: 'cantidad'
                    },
                    {
                        data: 'precio',
                        name: 'precio'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    }
                ],
                drawCallback: function(settings) {
                    // Imprimir respuesta de DataTables (cuando se termina de dibujar la tabla)
                    console.log("Datos de pedidos cargados:", settings);
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/reporte/reporte.blade.php ENDPATH**/ ?>