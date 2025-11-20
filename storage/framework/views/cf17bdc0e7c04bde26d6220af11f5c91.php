

<?php $__env->startSection('title', 'Cajas'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Caja - <?php echo e($sucursal->nombre); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header text-white">
                <?php if($cajaAbierta): ?>
                    <button class="btn btn-primary" disabled>
                        <i class="fas fa-plus"></i> Abrir Caja (Ya hay una caja abierta)
                    </button>
                <?php else: ?>
                    <a href="<?php echo e(route('cajas.create', ['id' => $id])); ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Abrir Caja
                    </a>
                <?php endif; ?>
                <a href="<?php echo e(route('cajas.sucursales')); ?>" class="btn btn-info">
                    <i class="fas fa-arrow-left"></i> Volver atrás
                </a>
            </div>


            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="cajasTable">
                        <thead>
                            <tr>
                                <th>Fecha Apertura</th>
                                <th>Fecha Cierre</th>
                                <th>Usuario Apertura</th>
                                <th>Usuario Cierre</th>
                                <th>Monto Inicial</th>
                                <th>Monto Vendido</th>
                                <th>Monto Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inicializar DataTable
            var table = $('#cajasTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?php echo e(route('cajas.index', ['id' => $id])); ?>",
                    data: function(d) {
                        d.usuario_apertura = $('#search_usuario_apertura').val();
                        d.fecha_apertura = $('#search_fecha_apertura').val();
                        d.fecha_cierre = $('#search_fecha_cierre').val();
                    }
                },
                columns: [{
                        data: 'fecha_apertura'
                    },
                    {
                        data: 'fecha_cierre'
                    },
                    {
                        data: 'usuario_apertura',
                        name: 'user.name'
                    },
                    {
                        data: 'usuario_cierre',
                        name: 'userCierre.name',
                        defaultContent: 'Sin Cierre'
                    },
                    {
                        data: 'monto_inicial'
                    },

                    {
                        data: 'monto_total'
                    },
                    {
                        data: 'monto_total',
                        render: function(data, type, row) {
                            return (parseFloat(row.monto_total) + parseFloat(row.monto_inicial))
                                .toFixed(2);
                        }
                    },
                    {
                        data: 'acciones',
                        orderable: false,
                        searchable: false
                    }
                ],
                responsive: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-MX.json"
                }
            });

            // Filtrar cuando el usuario haga clic en el botón
            $('#filterBtn').on('click', function() {
                table.draw(); // Redibuja la tabla con los filtros aplicados
            });
        });
    </script>
    <?php if(session('error')): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?php echo e(session('
                        error ')); ?>',
            });
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <style>
        .container {
            max-width: 1200px;
        }

        .card {
            border-radius: 10px;
        }

        .card-header {
            border-radius: 10px 10px 0 0;
        }

        .btn {
            border-radius: 8px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .card-body {
            padding: 1.5rem;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/cajas/index.blade.php ENDPATH**/ ?>