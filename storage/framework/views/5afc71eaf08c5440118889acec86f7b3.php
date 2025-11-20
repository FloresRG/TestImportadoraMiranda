

<?php $__env->startSection('template_title'); ?>
    Pedidos
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <?php echo e(__('Pedidos')); ?>

                            </span>
                        </div>
                    </div>

                    <?php if($message = Session::get('success')): ?>
                        <div class="alert alert-success m-4">
                            <p><?php echo e($message); ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="card-body bg-white">
                        <!-- Filtros -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="search_nombre">Nombre</label>
                                <input type="text" id="search_nombre" class="form-control" placeholder="Buscar por Nombre">
                            </div>
                            <div class="col-md-4">
                                <label for="search_estado">Estado</label>
                                <select id="search_estado" class="form-control">
                                    <option value="">Seleccionar Estado</option>
                                    <option value="POR COBRAR">POR COBRAR</option>
                                    <option value="PAGADO">PAGADO</option>
                                    <!-- Puedes agregar más opciones aquí -->
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="search_semana">Id Semana</label>
                                <select id="search_semana" class="form-control">
                                    <option value="">Seleccionar Semana</option>
                                    <?php $__currentLoopData = $semanas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $semana): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($semana->id); ?>"><?php echo e($semana->nombre); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <button id="filterBtn" class="btn btn-primary mb-3">Filtrar</button>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="pedidosTable">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Nombre</th>
                                        <th>Ci</th>
                                        <th>Celular</th>
                                        <th>Destino</th>
                                        <th>Direccion</th>
                                        <th>Estado</th>
                                        <th>Cantidad Productos</th>
                                        <th>Detalle</th>
                                        <th>Productos</th>
                                        <th>Monto Deposito</th>
                                        <th>Monto Enviado Pagado</th>
                                        <th>Fecha</th>
                                        <th>Id Semana</th>
                                        <th>Codigo</th>
                                        <th>Operaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Ajax cargará los datos aquí -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <!-- DataTables JS & CSS (CDN) -->
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>

    <!-- Importación de SlimSelect -->
    <script src="https://unpkg.com/slim-select@latest/dist/slimselect.min.js"></script>
    <link href="https://unpkg.com/slim-select@latest/dist/slimselect.css" rel="stylesheet">

    <script>
        $(document).ready(function() {
            // Inicializar DataTable
            var table = $('#pedidosTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '<?php echo e(route('pedido.index')); ?>',
                    data: function(d) {
                        // Enviar filtros al servidor
                        d.nombre = $('#search_nombre').val();
                        d.estado = $('#search_estado').val();
                        d.id_semana = $('#search_semana').val();
                    }
                },
                columns: [
                    { data: 'id' },
                    { data: 'nombre' },
                    { data: 'ci' },
                    { data: 'celular' },
                    { data: 'destino' },
                    { data: 'direccion' },
                    { data: 'estado' },
                    { data: 'cantidad_productos' },
                    { data: 'detalle' },
                    { data: 'productos' },
                    { data: 'monto_deposito' },
                    { data: 'monto_enviado_pagado' },
                    { data: 'fecha' },
                    { data: 'semana' },
                    { data: 'codigo' },
                    { data: 'action', orderable: false, searchable: false }
                ],
                responsive: true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-MX.json" // Traducción al español
                }
            });

            // Filtrar cuando el usuario haga clic en el botón
            $('#filterBtn').on('click', function() {
                table.draw();  // Redibuja la tabla con los filtros aplicados
            });

            // Inicializar SlimSelect para el select de semana
            new SlimSelect({
                select: '#search_semana'
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/pedido/index.blade.php ENDPATH**/ ?>