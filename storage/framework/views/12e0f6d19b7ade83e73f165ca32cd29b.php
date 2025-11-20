

<?php $__env->startSection('title', 'Crear Rol'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="text-center font-weight-bold">Crear Rol</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between mb-4">
        <a class="btn btn-danger" href="<?php echo e(route('roles.index')); ?>">
            <i class="fas fa-arrow-left"></i> Volver Atrás
        </a>
    </div>

    <form action="<?php echo e(route('roles.store')); ?>" method="POST" class="bg-light p-4 rounded shadow-sm">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="role_name" class="font-italic"><strong>Nombre del Rol</strong></label>
            <input type="text" class="form-control" id="role_name" name="name" required placeholder="Introduzca el nuevo Rol" aria-describedby="roleNameHelp">
            <small id="roleNameHelp" class="form-text text-muted">Por favor, introduzca un nombre único para el rol.</small>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="select-all" aria-label="Seleccionar todos los permisos">
            <label class="form-check-label" for="select-all"><strong>Seleccionar / Deseleccionar todos los permisos</strong></label>
        </div>

        <div class="row">
            <?php $__currentLoopData = $groupedPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $permissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-header bg-info text-white text-center">
                            <h5 class="font-weight-bold"><?php echo e($group); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="form-check mb-2">
                                <input class="form-check-input group-checkbox" type="checkbox" id="select-group-<?php echo e($group); ?>" aria-label="Seleccionar grupo de permisos">
                                <label class="form-check-label" for="select-group-<?php echo e($group); ?>"><strong>Seleccionar / Deseleccionar este grupo</strong></label>
                            </div>
                            <div class="form-group">
                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-check">
                                        <input class="form-check-input permission-checkbox" type="checkbox" id="permission_<?php echo e($permission->id); ?>" name="permissions[]" value="<?php echo e($permission->name); ?>">
                                        <label class="form-check-label" for="permission_<?php echo e($permission->id); ?>">
                                            <span style="font-family: 'Courier New', Courier, monospace;"><?php echo e($permission->descripcion); ?></span>
                                        </label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <button type="submit" class="btn btn-success btn-lg btn-block">
            <i class="fas fa-check"></i> Crear Rol
        </button>
    </form>

    <script>
        document.getElementById('select-all').addEventListener('click', function(event) {
            let isChecked = event.target.checked;
            let checkboxes = document.querySelectorAll('.permission-checkbox');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });
        });

        document.querySelectorAll('.group-checkbox').forEach(groupCheckbox => {
            groupCheckbox.addEventListener('click', function() {
                let groupPermissions = this.closest('.col-md-3').querySelectorAll('.permission-checkbox');
                groupPermissions.forEach(checkbox => {
                    checkbox.checked = groupCheckbox.checked;
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/roles/create.blade.php ENDPATH**/ ?>