

<?php $__env->startSection('title', 'Editar Proveedor'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('proveedores.index')); ?>">Proveedores</a></li>
    <li class="breadcrumb-item active">Editar</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-purple">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Edición</h3>
                </div>
                
                <form action="<?php echo e(route('proveedores.update', $proveedor->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Nombre del Proveedor -->
                                <div class="form-group">
                                    <label for="nombre">Nombre del Proveedor <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="nombre" name="nombre" value="<?php echo e(old('nombre', $proveedor->nombre)); ?>" required>
                                    <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                
                                <!-- Código de Factura -->
                                <div class="form-group">
                                    <label for="codigo_factura">Código de Factura <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['codigo_factura'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="codigo_factura" name="codigo_factura" value="<?php echo e(old('codigo_factura', $proveedor->codigo_factura)); ?>" required>
                                    <?php $__errorArgs = ['codigo_factura'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                
                                <!-- Pago Inicial -->
                                <div class="form-group">
                                    <label for="pago_inicial">Pago Inicial <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" step="0.01" min="0" class="form-control <?php $__errorArgs = ['pago_inicial'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                               id="pago_inicial" name="pago_inicial" value="<?php echo e(old('pago_inicial', $proveedor->pago_inicial)); ?>" required>
                                        <?php $__errorArgs = ['pago_inicial'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <!-- Deuda Total -->
                                <div class="form-group">
                                    <label for="deuda_total">Deuda Total <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" step="0.01" min="0" class="form-control <?php $__errorArgs = ['deuda_total'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                               id="deuda_total" name="deuda_total" value="<?php echo e(old('deuda_total', $proveedor->deuda_total)); ?>" required>
                                        <?php $__errorArgs = ['deuda_total'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                
                                <!-- Fecha de Registro -->
                                <div class="form-group">
                                    <label for="fecha_registro">Fecha de Registro <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control <?php $__errorArgs = ['fecha_registro'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="fecha_registro" name="fecha_registro" value="<?php echo e(old('fecha_registro', $proveedor->fecha_registro)); ?>" required>
                                    <?php $__errorArgs = ['fecha_registro'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                
                                <!-- Estado -->
                                <div class="form-group">
                                    <label for="estado">Estado <span class="text-danger">*</span></label>
                                    <select class="form-control <?php $__errorArgs = ['estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="estado" name="estado" required>
                                        <option value="Pagado" <?php echo e(old('estado', $proveedor->estado) == 'Pagado' ? 'selected' : ''); ?>>Pagado</option>
                                        <option value="Saldo pendiente" <?php echo e(old('estado', $proveedor->estado) == 'Saldo pendiente' ? 'selected' : ''); ?>>Saldo pendiente</option>
                                    </select>
                                    <?php $__errorArgs = ['estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                
                        <!-- Foto de Factura -->
                        <div class="form-group">
                            <label for="foto_factura">Foto de Factura</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input <?php $__errorArgs = ['foto_factura'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="foto_factura" name="foto_factura">
                                    <label class="custom-file-label" for="foto_factura">Seleccionar archivo</label>
                                </div>
                            </div>
                            <?php $__errorArgs = ['foto_factura'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                
                            <?php if($proveedor->foto_factura): ?>
                                <div class="mt-2">
                                    <img src="<?php echo e(Storage::url($proveedor->foto_factura)); ?>" alt="Factura" class="img-thumbnail" style="max-height: 200px;">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                
                    <div class="card-footer">
                        <button type="submit" class="btn btn-purple">Actualizar Proveedor</button>
                        <a href="<?php echo e(route('proveedores.index')); ?>" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')); ?>"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/proveedores/edit.blade.php ENDPATH**/ ?>