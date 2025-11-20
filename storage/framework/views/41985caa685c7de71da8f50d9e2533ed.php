
<?php $__env->startSection('title', 'Reporte de Ventas del Usuario'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h2 class="card-title">Reporte de Ventas - Importadora Miranda</h2>
            </div>
            <div class="card-body">
                <!-- Formulario de Filtro de Fecha -->
                <form action="<?php echo e(route('report.user.ventas')); ?>" method="GET" class="form-inline mb-4">
                    <div class="form-group mr-3">
                        <label for="start_date" class="mr-2 font-weight-bold">Fecha Inicio:</label>
                        <input type="date" id="start_date" name="start_date" class="form-control"
                            value="<?php echo e(request('start_date')); ?>">
                    </div>
                    <div class="form-group mr-3">
                        <label for="end_date" class="mr-2 font-weight-bold">Fecha Fin:</label>
                        <input type="date" id="end_date" name="end_date" class="form-control"
                            value="<?php echo e(request('end_date')); ?>">
                    </div>
                    <div class="form-group mr-3">
                        <label for="id_sucursal" class="mr-2 font-weight-bold">Sucursal:</label>
                        <select id="id_sucursal" name="id_sucursal" class="form-control">
                            <option value="">-- Todas las sucursales --</option>
                            <?php $__currentLoopData = $sucursales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sucursal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($sucursal->id); ?>"
                                    <?php echo e(request('id_sucursal') == $sucursal->id ? 'selected' : ''); ?>>
                                    <?php echo e($sucursal->nombre); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group mr-3">
                        <label for="id_user" class="mr-2 font-weight-bold">TIPO DE PAGO:</label>
                        <!-- Filtro por tipo de pago -->
                        <select name="tipo_pago" class="form-control">
                            <option value="">Todos los tipos de pago</option>
                            <option value="QR" <?php echo e(request('tipo_pago') == 'QR' ? 'selected' : ''); ?>>QR</option>
                            <option value="EFECTIVO" <?php echo e(request('tipo_pago') == 'EFECTIVO' ? 'selected' : ''); ?>>EFECTIVO
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary font-weight-bold mr-2">
                        <i class="fas fa-filter"></i> Filtrar
                    </button>
                    <a href="<?php echo e(route('report.user.ventas.pdf', request()->all())); ?>"
                        class="btn btn-success font-weight-bold" target="_blank">
                        <i class="fas fa-file-pdf"></i> Generar PDF
                    </a>
                </form>

                <!-- Resumen de Ventas -->
                <div class="mb-5 p-4 bg-light rounded shadow-sm border">
                    <h3 class="text-secondary font-weight-bold">Resumen de Ventas</h3>
                    <ul class="list-unstyled mt-3">
                        <li><strong>Costo Total:</strong> <?php echo e(number_format($totalCosto, 2)); ?> Bs</li>
                        <li><strong>Utilidad Bruta:</strong> <?php echo e(number_format($totalUtilidadBruta, 2)); ?> Bs</li>
                        <li><strong>Número de Ventas:</strong> <?php echo e($totalVentas); ?></li>
                        <li><strong>Número de Productos Vendidos:</strong> <?php echo e($totalProductosVendidos); ?></li>
                        <li><strong>Total de Ventas (Bs):</strong> <?php echo e(number_format($totalVentasBs, 2)); ?> Bs</li>
                    </ul>
                </div>

                <!-- Tabla de Detalles de Ventas -->
                <div class="table-responsive">
                    <table id="ventas-reporte-table" class="table table-bordered table-hover table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Fecha</th>
                                <th>Nombre del Cliente</th>
                                <th>Costo Total</th>
                                <th>Usuario</th>
                                <th>Tipo de Pago</th>
                                <th>Cantidad</th>
                                <th>Productos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $ventas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($venta->fecha); ?></td>
                                    <td><?php echo e($venta->nombre_cliente ?? 'N/A'); ?></td>
                                    <td><?php echo e(number_format($venta->costo_total, 2)); ?> Bs</td>
                                    <td><?php echo e($venta->user->name ?? 'N/A'); ?></td>
                                    <td><?php echo e($venta->tipo_pago ?? 'N/A'); ?></td>
                                    <td><?php echo e($venta->ventaProductos->sum('cantidad')); ?></td>
                                    <td><?php echo e($venta->ventaProductos->map(fn($p) => $p->producto->nombre . ' (' . $p->cantidad . ')')->implode(', ') ?? 'N/A'); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <style>
        .card-header {
            background: linear-gradient(90deg, rgba(75, 178, 180, 1) 0%, rgba(0, 15, 173, 1) 50%, rgba(99, 38, 190, 1) 100%);
            color: white;
        }

        .table thead th {
            background-color: #343a40;
            color: #fff;
            text-align: center;
        }

        .table-hover tbody tr:hover {
            background-color: #f2f2f2;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn {
            border-radius: 20px;
        }

        .form-group label {
            font-size: 14px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('js'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#ventas-reporte-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/report/user_ventas.blade.php ENDPATH**/ ?>