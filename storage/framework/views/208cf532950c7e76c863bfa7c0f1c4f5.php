<?php $__env->startSection('template_title'); ?>
    <?php echo e(__('Edit')); ?> Sucursale
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo e(__('Edit')); ?> Sucursale</h3>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="<?php echo e(route('sucursales.update', $sucursale->id)); ?>" role="form" enctype="multipart/form-data">
                            <?php echo method_field('PATCH'); ?>
                            <?php echo csrf_field(); ?>

                            <!-- Campo Nombre -->
                            <div class="form-group mb-3">
                                <label for="nombre" class="form-label">
                                    <i class="fas fa-building"></i> <?php echo e(__('Nombre')); ?>

                                </label>
                                <input type="text" name="nombre" class="form-control <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       value="<?php echo e(old('nombre', $sucursale->nombre)); ?>" id="nombre" placeholder="Nombre" required>
                                <?php echo $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

                            </div>

                            <!-- Campo Dirección -->
                            <div class="form-group mb-3">
                                <label for="direccion" class="form-label">
                                    <i class="fas fa-map-marker-alt"></i> <?php echo e(__('Dirección')); ?>

                                </label>
                                <input type="text" name="direccion" class="form-control <?php $__errorArgs = ['direccion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       value="<?php echo e(old('direccion', $sucursale->direccion)); ?>" id="direccion" placeholder="Dirección" required>
                                <?php echo $errors->first('direccion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

                            </div>

                            <!-- Campo Celular -->
                            <div class="form-group mb-3">
                                <label for="celular" class="form-label">
                                    <i class="fas fa-phone"></i> <?php echo e(__('Celular')); ?>

                                </label>
                                <input type="text" name="celular" class="form-control <?php $__errorArgs = ['celular'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       value="<?php echo e(old('celular', $sucursale->celular)); ?>" id="celular" placeholder="Celular" required>
                                <?php echo $errors->first('celular', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

                            </div>

                            <!-- Campo Estado -->
                            <div class="form-group mb-3">
                                <label for="estado" class="form-label">
                                    <i class="fas fa-toggle-on"></i> <?php echo e(__('Estado')); ?>

                                </label>
                                <select name="estado" class="form-control <?php $__errorArgs = ['estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="estado" required>
                                    <option value="activo" <?php echo e(old('estado', $sucursale->estado) == 'activo' ? 'selected' : ''); ?>>Activo</option>
                                    <option value="inactivo" <?php echo e(old('estado', $sucursale->estado) == 'inactivo' ? 'selected' : ''); ?>>Inactivo</option>
                                   </select>
                                <?php echo $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

                            </div>

                            <!-- Campo Logo -->
                            <div class="form-group mb-3">
                                <label for="logo" class="form-label">
                                    <i class="fas fa-image"></i> <?php echo e(__('Logo')); ?>

                                </label>
                                <input type="file" name="logo" class="form-control <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="logo">
                                <?php echo $errors->first('logo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

                            </div>
                            
                            <!-- Mostrar el logo actual si existe -->
                            <?php if($sucursale->logo): ?>
                                <div class="form-group mt-3">
                                    <label>Logo Actual:</label>
                                    <img src="<?php echo e(asset('storage/' . $sucursale->logo)); ?>" alt="Logo" class="img-fluid" style="max-width: 100px; height: auto;">
                                </div>
                            <?php endif; ?>

                            <!-- Botón de Enviar -->
                            <div class="form-group text-center mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> <?php echo e(__('Submit')); ?>

                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/sucursale/edit.blade.php ENDPATH**/ ?>