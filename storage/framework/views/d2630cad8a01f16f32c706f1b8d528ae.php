

<?php $__env->startSection('title', 'Registrar Pago'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1><i class="fas fa-money-bill-wave mr-2"></i>Registrar Pago</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-body">
        
                    
        <form action="<?php echo e(route('pagos.store')); ?>" method="POST" enctype="multipart/form-data">    <?php echo csrf_field(); ?>
            <?php if(isset($proveedor_id)): ?>
                <input type="hidden" name="proveedor_id" value="<?php echo e($proveedor_id); ?>">
            <?php endif; ?>

            <div class="row">
                <div class="col-md-6">
                    <?php if(!isset($proveedor_id)): ?>
                        <div class="form-group">
                            <label for="proveedor_id">Proveedor</label>
                            <select name="proveedor_id" class="form-control <?php $__errorArgs = ['proveedor_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="">Seleccione un proveedor</option>
                                <?php $__currentLoopData = $proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proveedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($proveedor->id); ?>" data-saldo="<?php echo e($proveedor->saldo_pendiente); ?>">
                                        <?php echo e($proveedor->nombre); ?> - Saldo: $<?php echo e(number_format($proveedor->saldo_pendiente, 2)); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['proveedor_id'];
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
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="foto_factura">Foto de Factura</label>
                        <input type="file" name="foto_factura" class="form-control-file" accept="image/*">
                    </div>
                    

                    <div class="form-group">
                        <label for="monto_pago">Monto a Pagar</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" step="0.01" name="monto_pago" 
                                class="form-control <?php $__errorArgs = ['monto_pago'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                required value="<?php echo e(old('monto_pago')); ?>">
                        </div>
                        <?php $__errorArgs = ['monto_pago'];
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

                    <div class="form-group">
                        <label for="fecha_pago">Fecha de Pago</label>
                        <input type="date" name="fecha_pago" 
                            class="form-control <?php $__errorArgs = ['fecha_pago'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('fecha_pago', date('Y-m-d'))); ?>" required>
                        <?php $__errorArgs = ['fecha_pago'];
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

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i>Guardar Pago
                        </button>
                        <a href="<?php echo e(route('proveedores.index')); ?>" class="btn btn-secondary">
                            <i class="fas fa-times mr-1"></i>Cancelar
                        </a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle mr-2"></i>
                        <strong>Nota:</strong> El pago se registrará y actualizará automáticamente el saldo pendiente del proveedor.
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
$(document).ready(function() {
    $('select[name="proveedor_id"]').change(function() {
        const saldoPendiente = $(this).find('option:selected').data('saldo');
        $('input[name="monto_pago"]').attr('max', saldoPendiente);
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/pagos/create.blade.php ENDPATH**/ ?>