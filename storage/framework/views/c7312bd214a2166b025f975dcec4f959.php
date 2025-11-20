<!-- Modal del carrito -->
<div id="carritoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="carritoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h5 class="modal-title" id="carritoModalLabel">Productos en el Carrito</h5>
                <div class="row align-items-center w-50">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-6 d-flex justify-content-start">
                        <label class="mr-3 mb-0">Garantía:</label>
                        <div class="toggle-button-cover">
                            <div id="button-3" class="button r">
                                <input class="checkbox" type="checkbox" name="garantia" id="garantia_switch" value="con garantia" unchecked>
                                <div class="knobs"></div>
                                <div class="layer"></div>
                            </div>
                        </div>
                        <input type="hidden" name="garantia" id="garantia_hidden" value="sin garantia">
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-info btn-sm mr-2" id="ver-qr" data-toggle="modal" data-target="#qrModal" data-dismiss="modal">
                        Ver QR
                    </button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table id="lista-carrito" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cliente">Cliente</label>
                            <input type="text" name="nombre_cliente" id="cliente" class="form-control" placeholder="Ingrese nombre del cliente" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ci">CI / NIT</label>
                            <input type="text" name="ci" id="ci" class="form-control" placeholder="Ingrese CI del cliente" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="d-flex align-items-center mb-2">
                                <label for="vendedorSearch" class="mr-3 mb-0"><strong>¿Elegir vendedor?</strong></label>
                                <div class="toggle-button-cover-vendedor">
                                    <div id="button-vendedor" class="button-vendedor r">
                                        <input class="checkbox-vendedor" type="checkbox" name="usar_vendedor" id="usar_vendedor_switch" value="si">
                                        <div class="knobs-vendedor"></div>
                                        <div class="layer-vendedor"></div>
                                    </div>
                                </div>
                                <input type="hidden" name="usar_vendedor" id="usar_vendedor_hidden" value="no">
                            </div>

                            <input type="text" id="vendedorSearch" class="form-control" placeholder="Escribe para buscar vendedor..." list="sugerencias_vendedores" disabled>
                            <datalist id="sugerencias_vendedores">
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->name); ?>" data-id="<?php echo e($user->id); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </datalist>

                            <input type="hidden" name="id_user" id="id_user" value="<?php echo e($defaultVendedorId); ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="descuento">Descuento (Bs)</label>
                            <input type="number" name="descuento" id="descuento" class="form-control" value="0">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="monto-total">Total Sin Descuento</label>
                            <input type="number" id="monto-total" name="monto_total_sin_descuento" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="total-a-pagar">Monto Total a Pagar</label>
                            <input type="number" name="costo_total" id="total-a-pagar" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tipo_pago">Método de Pago</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="checkbox-wrapper">
                                        <input required type="radio" name="tipo_pago" value="Efectivo" id="efectivo_radio">
                                        <div class="checkmark">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path d="M20 6L9 17L4 12" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </div>
                                        <span class="label">Efectivo</span>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label class="checkbox-wrapper">
                                        <input type="radio" name="tipo_pago" value="QR" id="transferencia_bancaria_radio">
                                        <div class="checkmark">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path d="M20 6L9 17L4 12" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </div>
                                        <span class="label">QR</span>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label class="checkbox-wrapper">
                                        <input type="radio" name="tipo_pago" value="Efectivo y QR" id="pago_efectivo_qr_radio">
                                        <div class="checkmark">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path d="M20 6L9 17L4 12" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </div>
                                        <span class="label">Efectivo y QR</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" id="monto-pagado-container">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pagado" id="monto-pagado-label">Monto Pagado</label>
                            <input type="number" id="pagado" class="form-control" placeholder="Ingrese monto pagado">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cambio">Cambio</label>
                            <input type="text" id="cambio" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6" id="pagos-efectivo-qr" style="display:none;">
                        <div class="form-group">
                            <label for="pagado_qr">Monto Pagado por QR</label>
                            <input type="number" id="pagado_qr" class="form-control" placeholder="Ingrese monto pagado por QR">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <a href="#" id="vaciar-carrito-fvc" class="btn btn-danger">Vaciar</a>
                <button type="submit" class="btn btn-success">Confirmar venta</button>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\Trabajo Nexus\TestImportadoraMiranda\resources\views/control/partials/cart-modal.blade.php ENDPATH**/ ?>