<div class="row padding-1 p-1">
    <div class="col-md-12">

        <!-- Codigo -->
        <div class="form-group mb-2 mb20">
            <label for="codigo" class="form-label"><?php echo e(__('Codigo')); ?></label>
            <div class="input-group">
                <input type="text" name="codigo" class="form-control <?php $__errorArgs = ['codigo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('codigo', $cupo?->codigo)); ?>" id="codigo" placeholder="Codigo">
                <div class="input-group-append">
                    <button type="button" id="generate-code" class="btn btn-info">Generar Código</button>
                </div>
            </div>
            <?php echo $errors->first('codigo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

            <div id="code-validation-message"></div>
        </div>

        <!-- Porcentaje -->
        <div class="form-group mb-2 mb20">
    <input type="text" name="porcentaje" class="form-control <?php $__errorArgs = ['porcentaje'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
           value="<?php echo e(old('porcentaje', 0)); ?>" id="porcentaje" placeholder="Porcentaje" style="display:none;">
    <?php echo $errors->first('porcentaje', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

</div>


        <!-- Estado (Select) -->
        <div class="form-group mb-2 mb20">
            <select name="estado" class="form-control <?php $__errorArgs = ['estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="estado" hidden>
                <option value="Activo" <?php echo e(old('estado', $cupo?->estado) == 'Activo' ? 'selected' : ''); ?>>Activo</option>
                <option value="Inactivo" <?php echo e(old('estado', $cupo?->estado) == 'Inactivo' ? 'selected' : ''); ?>>Inactivo</option>
            </select>
            <?php echo $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

        </div>

        <!-- Fecha de Inicio -->
        <div class="form-group mb-2 mb20">
            <label for="fecha_inicio" class="form-label"><?php echo e(__('INGRESE FECHA Y HORA DE ACTIVACION')); ?></label>
            <input type="datetime-local" name="fecha_inicio" class="form-control <?php $__errorArgs = ['fecha_inicio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('fecha_inicio', $cupo?->fecha_inicio ? $cupo->fecha_inicio->format('Y-m-d\TH:i') : '')); ?>" id="fecha_inicio" placeholder="Fecha de Inicio">
            <?php echo $errors->first('fecha_inicio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

        </div>

        <!-- Fecha de Fin -->
        <div class="form-group mb-2 mb20">
            <label for="fecha_fin" class="form-label"><?php echo e(__('INGRESE FECHA Y HORA DE DESACTIVACION')); ?></label>
            <input type="datetime-local" name="fecha_fin" class="form-control <?php $__errorArgs = ['fecha_fin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('fecha_fin', $cupo?->fecha_fin ? $cupo->fecha_fin->format('Y-m-d\TH:i') : '')); ?>" id="fecha_fin" placeholder="Fecha de Fin">
            <?php echo $errors->first('fecha_fin', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

        </div>

        <!-- ID de Usuario (para "admin" o el usuario logueado) -->
        <div class="form-group mb-2 mb20">
            <input type="text" name="id_user" class="form-control <?php $__errorArgs = ['id_user'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('id_user', auth()->user()->id)); ?>" id="id_user" readonly hidden>
            <?php echo $errors->first('id_user', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

        </div>

    </div>

    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
    </div>
</div>

<?php $__env->startSection('js'); ?>
    <script>
        // Función para generar un código único con las palabras "envivo", "importadora" y "miranda"
        function generateUniqueCode() {
            // Generamos el código con las palabras clave y un sufijo aleatorio
            const prefix = 'I-M-Y';
            const randomString = Math.random().toString(36).substr(2, 6).toUpperCase(); // Generar una cadena aleatoria
            const code = prefix + randomString;

            // Asignamos el código generado al campo de entrada
            document.getElementById('codigo').value = code;

            // Verificar si el código generado ya existe en la base de datos
            checkCodeAvailability(code);
        }

        // Función para verificar si el código ya existe en la base de datos
        function checkCodeAvailability(code) {
            const messageElement = document.getElementById('code-validation-message');

            // Realizar la solicitud AJAX para verificar si el código existe
            fetch(`/check-code-existence/${code}`)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        messageElement.innerHTML = '<span class="text-danger">Este código ya existe.</span>';
                        document.getElementById('generate-code').disabled = true; // Deshabilitar botón
                    } else {
                        messageElement.innerHTML = '<span class="text-success">Este código está disponible.</span>';
                        document.getElementById('generate-code').disabled = false; // Habilitar botón
                    }
                });
        }

        // Evento para generar el código cuando se hace clic en el botón
        document.getElementById('generate-code').addEventListener('click', function () {
            generateUniqueCode();
        });

        // Evento para la validación en tiempo real al escribir en el campo de código
        document.getElementById('codigo').addEventListener('blur', function () {
            const code = this.value;
            if (code) {
                checkCodeAvailability(code);
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/cupo/form.blade.php ENDPATH**/ ?>