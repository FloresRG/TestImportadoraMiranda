

<?php $__env->startSection('adminlte_css'); ?>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery (necesario para DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <h1>Listado de Productos y Precios</h1>

        <div class="card shadow-lg border-0" style="border-radius: 15px;">
            <div class="card-body" style="background: #f8f9fa;">
                <thead class="linear-gradient">
                    <table class="table table-bordered table-striped" id="productos-table">
                        <thead class="linear-gradient">
                            <tr>
                                <th>Nombre del Producto</th>
                                <?php if(auth()->user()->hasRole('Admin') && auth()->user()->name === 'yesenew@gmail.com'): ?>
                                    <th>Precio Jefa</th>
                                    <!-- Aquí puedes asegurarte de que la columna también se muestre en las filas del DataTable -->
                                <?php else: ?>
                                    <th></th>
                                <?php endif; ?>
                                <th>Precio Caja</th>
                                <th>cantidad</th>
                                <th>Precio Docena</th>
                                <th>Precio Unidad</th>
                                <?php if(auth()->user()->hasRole('Admin') && auth()->user()->name === 'Wuada'): ?>
                                    <th>Precio Preventa</th>
                                    <!-- Aquí puedes asegurarte de que la columna también se muestre en las filas del DataTable -->
                                <?php else: ?>
                                    <th></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

            </div>
        </div>

    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('adminlte_js'); ?>
    <script>
        // Configuración de AJAX con CSRF
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            var table = $('#productos-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '<?php echo e(route('precioproductos.data')); ?>',
                    type: 'GET',
                    dataSrc: function(json) {
                        return json.data;
                    }
                },
                columns: [{
                        data: 'nombre'
                    },
                    {
                        data: 'precio_jefa',
                        render: function(data, type, row) {
                            // Solo los administradores pueden editar el precio_jefa
                            <?php if(auth()->user()->hasRole('Admin') && auth()->user()->name === 'yesenew@gmail.com'): ?>
                                return '<input type="text" class="form-control precio-edit" data-id="' +
                                    row.id + '" name="precio_jefa" value="' + data + '">';
                            <?php else: ?>
                                return ''; // Si no es admin, no se muestra nada en la celda
                            <?php endif; ?>
                        }
                    },
                    {
                        data: 'precio_unitario',
                        render: function(data, type, row) {
                            // Los vendedores antiguos pueden editar este campo
                            <?php if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Vendedor Antiguo')): ?>
                                return '<input type="text" class="form-control precio-edit" data-id="' +
                                    row.id + '" name="precio_unitario" value="' + data + '">';
                            <?php else: ?>
                                return '<input type="text" class="form-control precio-edit" data-id="' +
                                    row.id + '" name="precio_unitario" value="' + data +
                                    '" readonly>';
                            <?php endif; ?>
                        }
                    },
                    {
                        data: 'cantidad',
                        render: function(data, type, row) {
                            // Los vendedores antiguos pueden editar este campo
                            <?php if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Vendedor Antiguo')): ?>
                                return '<input type="text" class="form-control precio-edit" data-id="' +
                                    row.id + '" name="cantidad" value="' + data + '">';
                            <?php else: ?>
                                return '<input type="text" class="form-control precio-edit" data-id="' +
                                    row.id + '" name="cantidad" value="' + data +
                                    '" readonly>';
                            <?php endif; ?>
                        }
                    },
                    {
                        data: 'precio_general',
                        render: function(data, type, row) {

                            <?php if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Vendedor Antiguo')): ?>
                                return '<input type="text" class="form-control precio-edit" data-id="' +
                                    row.id + '" name="precio_general" value="' + data + '">';
                            <?php else: ?>
                                return '<input type="text" class="form-control precio-edit" data-id="' +
                                    row.id + '" name="precio_general" value="' + data +
                                    '" readonly>';
                            <?php endif; ?>
                        }
                    },
                    {
                        data: 'precio_extra',
                        render: function(data, type, row) {

                            <?php if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Vendedor Antiguo')): ?>
                                return '<input type="text" class="form-control precio-edit" data-id="' +
                                    row.id + '" name="precio_extra" value="' + data + '">';
                            <?php else: ?>
                                return '<input type="text" class="form-control precio-edit" data-id="' +
                                    row.id + '" name="precio_extra" value="' + data + '"readonly>';
                            <?php endif; ?>
                        }
                    },
                    {
                        data: 'precio_preventa',
                        render: function(data, type, row) {

                            <?php if(auth()->user()->hasRole('Admin') && auth()->user()->name === 'Wuada'): ?>
                                return '<input type="text" class="form-control precio-edit" data-id="' +
                                    row.id + '" name="precio_preventa" value="' + data + '">';
                            <?php else: ?>
                                 return ''; // Si no es admin, no se muestra nada en la celda
                            <?php endif; ?>
                        }
                    }
                ]
            });

            $(document).on('change', '.precio-edit', function() {
                var productoId = $(this).data('id');
                var nombreCampo = $(this).attr('name');
                var valor = $(this).val();

                console.log('ID del producto:', productoId);
                console.log('Campo que se está actualizando:', nombreCampo);
                console.log('Nuevo valor:', valor);

                // Enviar solo el campo actualizado y su nuevo valor
                var data = {
                    campo: nombreCampo, // Nombre del campo que se está actualizando
                    valor: valor // Nuevo valor para el campo
                };

                console.log('Datos a enviar a la ruta:', data);

                // Hacer la solicitud AJAX para actualizar el precio
                $.ajax({
                    url: '/precioproductos/' + productoId + '/update', // Ruta de la API
                    type: 'POST',
                    data: data, // Solo enviamos el campo actualizado
                    success: function(response) {
                        if (response.success) {
                            console.log('Precio actualizado');
                            console.log('Datos actualizados:', response.data);
                        } else {
                            console.log('Error al actualizar el precio');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Error: ', error);
                    }
                });
            });




        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/precioproducto/index.blade.php ENDPATH**/ ?>