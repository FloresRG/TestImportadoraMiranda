

<?php $__env->startSection('title', 'Planilla de Pagos por Mes'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <h1 class="mb-4 text-center font-weight-bold" style="color: #2c3e50;">
            Planilla de Pagos - Año <?php echo e(date('Y')); ?>

        </h1>

        <div class="card shadow-lg mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="card-title m-0">Reportes de la Planilla</h5>
                <a href="<?php echo e(route('pagos.generateAllPdf')); ?>" class="btn btn-danger btn-lg-hover" target="_blank">
                    <i class="fas fa-file-pdf mr-2"></i> Generar PDF Completo 📄
                </a>
            </div>
        </div>

        <div class="card shadow-lg">
            <div class="card-body">
                
                <div class="table-responsive">
                    <table id="pagos-table" class="table table-hover rounded-lg" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-white">Usuario</th>
                                <?php for($i = 1; $i <= 12; $i++): ?>
                                    <th class="text-white text-center">
                                        <?php echo e(strtoupper(\Carbon\Carbon::create()->month($i)->translatedFormat('M'))); ?></th>
                                <?php endfor; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $mesActual = (int) date('n');
                                $anioActual = (int) date('Y');
                            ?>

                            <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="font-weight-bold"><?php echo e($usuario->name); ?></td>

                                    <?php for($mes = 1; $mes <= 12; $mes++): ?>
                                        <?php
                                            $clave = $usuario->id . '-' . str_pad($mes, 2, '0', STR_PAD_LEFT);
                                            $pagoUser = $pagos->get($clave)?->first();

                                            $ultimoPago = $pagos
                                                ->filter(function ($value, $key) use ($usuario, $mes) {
                                                    [$uid, $m] = explode('-', $key);
                                                    return $uid == $usuario->id && (int) $m < $mes;
                                                })
                                                ->sortByDesc(function ($value, $key) {
                                                    return explode('-', $key)[1];
                                                })
                                                ->first()
                                                ?->first();

                                            $pagoMesActual = $pagos
                                                ->get($usuario->id . '-' . str_pad($mesActual, 2, '0', STR_PAD_LEFT))
                                                ?->first();

                                            $anioCreacion = (int) $usuario->created_at->format('Y');
                                            $mesCreacion = (int) $usuario->created_at->format('n');

                                            $mostrarBoton = false;

                                            if (
                                                $anioCreacion < $anioActual ||
                                                ($anioCreacion == $anioActual && $mes >= $mesCreacion)
                                            ) {
                                                if ($mes <= $mesActual && !$pagoUser) {
                                                    $mostrarBoton = true;
                                                } elseif ($mes == $mesActual + 1 && $pagoMesActual) {
                                                    $mostrarBoton = true;
                                                }
                                            }
                                        ?>

                                        <td class="text-center">
                                            <?php if($pagoUser): ?>
                                                <div class="badge badge-pill badge-success p-2 mb-1">
                                                    Bs/ <?php echo e(number_format($pagoUser->pagoEmpleado->monto, 2)); ?>

                                                </div>
                                                <div class="small text-muted"><?php echo e(ucfirst($pagoUser->estado)); ?></div>
                                                <div class="btn-group mt-2" role="group">
                                                    <button class="btn btn-info btn-sm btn-icon" data-toggle="modal"
                                                        data-target="#modalVerPago"
                                                        data-monto="<?php echo e($pagoUser->pagoEmpleado->monto); ?>"
                                                        data-bono="<?php echo e($pagoUser->pagoEmpleado->bono_extra); ?>"
                                                        data-descuento="<?php echo e($pagoUser->pagoEmpleado->descuento); ?>"
                                                        data-total="<?php echo e($pagoUser->pagoEmpleado->total); ?>"
                                                        data-estado="<?php echo e($pagoUser->estado); ?>"
                                                        data-fecha="<?php echo e($pagoUser->fecha_pago); ?>"
                                                        data-descripcion="<?php echo e($pagoUser->pagoEmpleado->descripcion); ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <a href="<?php echo e(route('pagos.generatePdf', ['user' => $usuario->id, 'mes' => $mes])); ?>"
                                                        class="btn btn-danger btn-sm btn-icon" target="_blank">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a>
                                                </div>
                                            <?php elseif($mostrarBoton): ?>
                                                <button class="btn btn-success btn-block btn-pay" data-toggle="modal"
                                                    data-target="#modalPago" data-user="<?php echo e($usuario->id); ?>"
                                                    data-mes="<?php echo e($mes); ?>"
                                                    data-monto="<?php echo e($ultimoPago?->pagoEmpleado?->monto ?? ''); ?>"
                                                    data-bono="<?php echo e($ultimoPago?->pagoEmpleado?->bono_extra ?? ''); ?>"
                                                    data-descuento="<?php echo e($ultimoPago?->pagoEmpleado?->descuento ?? ''); ?>">
                                                    Pagar 💸
                                                </button>
                                            <?php else: ?>
                                                <span class="text-muted small"></span>
                                            <?php endif; ?>
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalPago" tabindex="-1" role="dialog" aria-labelledby="modalPagoLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" action="<?php echo e(route('pagos.realizar')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="user_id" id="modalUserId">
                    <input type="hidden" name="mes" id="modalMes">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Registrar Pago</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="fecha_pago">Fecha de Pago</label>
                                <input type="date" name="fecha_pago" class="form-control"
                                    value="<?php echo e(now()->format('Y-m-d')); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Monto</label>
                                <input type="number" step="0.01" name="monto" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Bono Extra</label>
                                <input type="number" step="0.01" name="bono_extra" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Descuento</label>
                                <input type="number" step="0.01" name="descuento" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea name="descripcion" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Total Calculado</label>
                                <input type="text" id="totalCalculado" class="form-control bg-light" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Registrar Pago</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="modalVerPago" tabindex="-1" role="dialog" aria-labelledby="modalVerPagoLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalle del Pago</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Monto:</strong> Bs/ <span id="verMonto"></span></p>
                        <p><strong>Bono Extra:</strong> Bs/ <span id="verBono"></span></p>
                        <p><strong>Descuento:</strong> Bs/ <span id="verDescuento"></span></p>
                        <p><strong>Total:</strong> Bs/ <span id="verTotal"></span></p>
                        <p><strong>Estado:</strong> <span id="verEstado"></span></p>
                        <p><strong>Fecha de Pago:</strong> <span id="verFecha"></span></p>
                        <p><strong>Descripción:</strong> <span id="verDescripcion"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        body {
            background-color: #ecf0f5;
            /* Fondo más suave */
        }

        .container {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        .card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        /* Se ajusta esta regla para eliminar la clase table-responsive-sm y solo dejar la envolvente */
        .table-responsive {
            border-radius: 10px;
            overflow-x: auto;
            /* Asegura el scroll horizontal si es necesario */
        }

        /* Estilo de la tabla */
        #pagos-table th {
            font-weight: 600;
            text-transform: uppercase;
        }

        #pagos-table tbody tr:nth-child(odd) {
            background-color: #f8f9fa;
            /* Color cebra para filas impares */
        }

        #pagos-table tbody tr:hover {
            background-color: #e9ecef;
            /* Resaltar al pasar el cursor */
            transition: background-color 0.2s ease-in-out;
        }

        #pagos-table td {
            vertical-align: middle;
            font-size: 0.95rem;
            white-space: nowrap;
            /* Evita que el contenido se divida en varias líneas */
        }

        /* Botones y badges */
        .btn-lg-hover {
            transition: transform 0.2s, background-color 0.2s;
        }

        .btn-lg-hover:hover {
            transform: scale(1.05);
            background-color: #c0392b;
            /* Rojo más oscuro en hover */
        }

        .btn-pay {
            background-color: #2ecc71;
            border-color: #2ecc71;
            color: white;
            transition: background-color 0.2s ease-in-out;
        }

        .btn-pay:hover {
            background-color: #27ae60;
        }

        .btn-icon {
            padding: 0.375rem 0.5rem;
        }

        .badge-success {
            background-color: #28a745;
            color: #fff;
            padding: 0.5em 0.8em;
            font-size: 0.85rem;
        }

        /* Modal */
        .modal-content {
            border-radius: 12px;
        }

        .modal-header {
            border-bottom: 1px solid #dee2e6;
        }

        .modal-footer {
            border-top: 1px solid #dee2e6;
        }

        /* Responsive adjustments para la tabla */
        @media (max-width: 767px) {
            #pagos-table {
                font-size: 0.8rem;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function() {
            $('#pagos-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "scrollX": true, // Habilita el scroll horizontal en DataTables
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                },
                "columnDefs": [{
                    "orderable": false,
                    "targets": '_all'
                }]
            });
        });

        function calcularTotal() {
            let monto = parseFloat($('input[name="monto"]').val()) || 0;
            let bono = parseFloat($('input[name="bono_extra"]').val()) || 0;
            let descuento = parseFloat($('input[name="descuento"]').val()) || 0;
            let total = monto + bono - descuento;
            $('#totalCalculado').val('Bs/ ' + total.toFixed(2));
        }

        $('#modalPago').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget);
            let userId = button.data('user');
            let mes = button.data('mes');
            let monto = button.data('monto');
            let bono = button.data('bono');
            let descuento = button.data('descuento');

            let nombreMes = new Date(0, mes - 1).toLocaleString('es-ES', {
                month: 'long'
            }).toUpperCase();

            $('#modalUserId').val(userId);
            $('#modalMes').val(mes);
            $('input[name="fecha_pago"]').val('<?php echo e(now()->format('Y-m-d')); ?>');
            $('input[name="monto"]').val(monto ?? '');
            $('input[name="bono_extra"]').val(bono ?? '');
            $('input[name="descuento"]').val(descuento ?? '');
            $('textarea[name="descripcion"]').val('PAGO POR EL MES DE ' + nombreMes);
            setTimeout(calcularTotal, 100);
        });

        $('input[name="monto"], input[name="bono_extra"], input[name="descuento"]').on('input', calcularTotal);

        <?php if(session('success')): ?>
            Swal.fire({
                icon: 'success',
                title: '¡Pago exitoso!',
                text: '<?php echo e(session('success')); ?>',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>

        $('#modalVerPago').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget);
            $('#verMonto').text(parseFloat(button.data('monto')).toFixed(2));
            $('#verBono').text(parseFloat(button.data('bono')).toFixed(2));
            $('#verDescuento').text(parseFloat(button.data('descuento')).toFixed(2));
            $('#verTotal').text(parseFloat(button.data('total')).toFixed(2));
            $('#verEstado').text(button.data('estado'));
            $('#verFecha').text(button.data('fecha'));
            $('#verDescripcion').text(button.data('descripcion'));
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/pagos/indexempleado.blade.php ENDPATH**/ ?>