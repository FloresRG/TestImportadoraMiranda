

<?php $__env->startSection('title', 'Crear Usuario'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Crear Usuarioooo</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container d-flex justify-content-center">
        <div class="col-md-6">
            <!-- Formulario con estilo personalizado -->
            <form action="<?php echo e(route('users.store')); ?>" method="POST" class="bg-light p-4 rounded shadow-sm">
                <?php echo csrf_field(); ?>

                <!-- Campo para el nombre -->
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" placeholder="Ingrese el nombre" required>
                </div>

                <!-- Campo para el email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Ingrese el email" required>
                </div>

                <!-- Campo para la contraseña -->
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="Ingrese la contraseña"
                        required>
                </div>

                <!-- Campo para seleccionar el rol -->
                <div class="form-group">
                    <label for="role">Rol</label>
                    <select name="role" class="form-control" required>
                        <option value="">Selecciona un rol</option>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($role->name); ?>"><?php echo e($role->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- Campo para seleccionar una sucursal -->
                <div class="form-group">
                    <label for="sucursal">Sucursal</label>
                    <select name="sucursal" class="form-control" required>
                        <option value="">Selecciona una sucursal</option>
                        <?php $__currentLoopData = $sucursales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sucursal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($sucursal->id); ?>"><?php echo e($sucursal->nombre); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <!-- Campo para el estado -->
                <div class="form-group">
                    <label for="status">Estado</label>
                    <div>
                        <input type="radio" name="status" value="active" required checked> Activo
                        <input type="radio" name="status" value="inactive" required> Inactivo
                    </div>
                </div>


                <!-- Botones de acción -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus"></i> Crear
                    </button>
                    <a href="<?php echo e(route('users.index')); ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                </div>
            </form>

            <!-- Mostrar los errores en caso de que existan -->
            <?php if($errors->any()): ?>
                <div class="alert alert-danger mt-3">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/users/create.blade.php ENDPATH**/ ?>