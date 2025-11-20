<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="tipo" class="form-label"><?php echo e(__('Tipo')); ?></label>
            <input type="text" name="tipo" class="form-control <?php $__errorArgs = ['tipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('tipo', $tipo?->tipo)); ?>" id="tipo" placeholder="Tipo">
            <?php echo $errors->first('tipo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
    </div>
</div><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/tipo/form.blade.php ENDPATH**/ ?>