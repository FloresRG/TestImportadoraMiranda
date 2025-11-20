

<?php $__env->startSection('title', 'Cancelar Ventas'); ?>

<?php $__env->startPush('css'); ?>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css">
    <!-- Custom Styles -->
    <style>
        /* General styles */
        body {
            background-color: #f4f6f9;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
            text-align: center;
            text-shadow: 1px 1px 2px #aaa;
        }

        /* Card styles */
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .card-header {
            background: linear-gradient(135deg, #4e73df, #df3383);


            border-radius: 15px 15px 0 0;
        }


        .card-body {
            background-color: #ffffff;
            border-radius: 0 0 15px 15px;
        }

        /* Buttons */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            border-radius: 50px;
            transition: all 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-danger {
            background-color: #e74a3b;
            border-color: #e74a3b;
            color: #fff;
            border-radius: 50px;
            transition: all 0.3s ease-in-out;
        }

        .btn-danger:hover {
            background-color: #c9302c;
            border-color: #c9302c;
        }








        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #fdfdfd;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        /* Form */
        .form-control {
            border-radius: 50px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-inline .form-group {
            margin-right: 15px;
        }

        label {
            font-weight: bold;
            color: #000;
        }
        .bg-red-soft {
        background-color: #f8d7da !important; /* Rojo suave */
        color: #721c24 !important;           /* Texto en tono oscuro */
    }

    </style>
    <link href="https://unpkg.com/slim-select@latest/dist/slimselect.css" rel="stylesheet">
    <!-- DataTables JS & CSS (CDN) -->
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('js'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>

    <!-- Importación de SlimSelect -->
    <script src="https://unpkg.com/slim-select@latest/dist/slimselect.min.js"></script>


    <script>
        $(document).ready(function() {
            const table = $('#ventas-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?php echo e(route('cancelarventa.index')); ?>",
                    data: function(d) {
                        d.fecha_inicio = $('#fecha_inicio').val();
                        d.fecha_fin = $('#fecha_fin').val();
                        d.sucursal_id = $('#sucursal_id').val();
                        d.user_id = $('#user_id').val();
                    }
                },
             createdRow: function(row, data, dataIndex) {
    if (data.estado === 'CANCELADA' || data.estado === 'Cancelada') {
        $(row).addClass('bg-red-soft');
        
    }
},

                columns: [
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return '<input type="checkbox" name="venta_ids[]" value="' + row.id +
                                '">';
                        }
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'fecha',
                        name: 'fecha'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name',
                        searchable: true
                    },
                    {
                        data: 'nombre_cliente',
                        name: 'nombre_cliente',
                        searchable: true
                    },
                    {
                        data: 'ci',
                        name: 'ci'
                    },
                    {
                        data: 'productos',
                        name: 'productos',
                        orderable: false
                    },
                    {
                        data: 'total_cantidad',
                        name: 'total_cantidad'
                    },
                    {
                        data: 'total_precio',
                        name: 'total_precio'
                    },
                  {
                        data: 'acciones',
                        name: 'acciones',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            if (row.estado === 'CANCELADA' || row.estado === 'Cancelada') {
                                return ''; // Retorna una celda vacía
                            }
                            return data; // Retorna el contenido original si no está cancelada
                        }
                    },
                    { 
                    data: 'estado', 
                    name: 'estado',
                    render: function(data, type, row) {
                        return `<span class="badge ${data === 'Activo' ? 'bg-success' : 'bg-danger'}">${data}</span>`;
                    }  },
                    
                ],
                responsive: true,
           
            });

            $('#reporte-form').on('submit', function(e) {
                e.preventDefault();
                table.ajax.reload();
            });
            // Manejar la selección de todos los checkboxes
            $('#select-all').on('click', function() {
                $('input[name="venta_ids[]"]').prop('checked', this.checked);
            });
            // Manejar el evento del botón "Generar Reporte"
            $('#generar-reporte').on('click', function() {
                const selected = $('input[name="venta_ids[]"]:checked');
                if (selected.length === 0) {
                    alert('Por favor, seleccione al menos una venta.');
                    return;
                }

                // Crear un formulario oculto para enviar los IDs seleccionados
                const form = $('<form>', {
                    method: 'POST',
                    action: '<?php echo e(route("cancelarventa.generarReporte")); ?>'
                }).append($('<input>', {
                    type: 'hidden',
                    name: '_token',
                    value: '<?php echo e(csrf_token()); ?>'
                }));

                selected.each(function() {
                    form.append($('<input>', {
                        type: 'hidden',
                        name: 'venta_ids[]',
                        value: $(this).val()
                    }));
                });

                $('body').append(form);
                form.submit();
            });
        });








    function devolucionRapida(ventaId) {
    if (confirm('¿Está seguro de realizar la devolución rápida de esta venta?')) {
        $.ajax({
            url: '/cancelarventa/devolucion-rapida/' + ventaId,
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: 'Devolución realizada correctamente',
                        icon: 'success'
                    });
                    $('#ventas-table').DataTable().ajax.reload();
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.message || 'Hubo un error al procesar la devolución',
                        icon: 'error'
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    title: 'Error',
                    text: xhr.responseJSON ? xhr.responseJSON.message : 'Hubo un error al procesar la devolución',
                    icon: 'error'
                });
            }
        });
    }
}



    </script>
<?php $__env->stopPush(); ?>



















<?php $__env->startSection('content'); ?>
    <div class="container">


        <h1 class="page-title">HISTORIAL DE VENTAS</h1>
        <!-- Filtros -->
        <div class="card mb-3">

            <div class="card-header">
                <i class="fas fa-filter"></i> Filtros de Búsqueda
            </div>
            <div class="card-body">
                <form id="reporte-form" action="<?php echo e(route('cancelarventa.index')); ?>" method="GET" class="form-inline">
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha Inicio:</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                            value="<?php echo e(request('fecha_inicio')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="fecha_fin">Fecha Fin:</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"
                            value="<?php echo e(request('fecha_fin')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="sucursal_id">Sucursal:</label>
                        <select name="sucursal_id" id="sucursal_id" class="form-control">
                            <option value="">Todas</option>
                            <?php $__currentLoopData = $sucursales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sucursal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($sucursal->id); ?>"
                                    <?php echo e(request('sucursal_id') == $sucursal->id ? 'selected' : ''); ?>>
                                    <?php echo e($sucursal->nombre); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="user_id">Vendedor:</label>
                        <select name="user_id" id="user_id" class="form-control">
                            <option value="">Todos</option>
                            <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($usuario->id); ?>"
                                    <?php echo e(request('user_id') == $usuario->id ? 'selected' : ''); ?>>
                                    <?php echo e($usuario->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filtrar</button>
                </form>
            </div>
        </div>


        
        <!-- Botón para generar reportes -->
        <button type="button" class="btn btn-success mb-3" id="generar-reporte"><i class="fas fa-file-pdf"></i> Generar
            Reporte</button>

        
        <div class="card-body">
            <i class="fas fa-table"></i> Ventas Registradas
            <div class="table-responsive">
                <table id="ventas-table" class="table table-striped table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th><input type="checkbox" id="select-all"></th> <!-- Checkbox para seleccionar todos -->
                            <th>ID Venta</th>
                            <th>Fecha de Venta</th>
                            <th>Vendedor</th>
                            <th>Cliente</th>
                            <th>CI</th>
                            <th>Productos</th>
                            <th>Cantidad Vendida</th>
                            <th>Precio Total</th>
                            <th>Acciones</th>
                            <th>Estado</th>

                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/cancelarventa/index.blade.php ENDPATH**/ ?>