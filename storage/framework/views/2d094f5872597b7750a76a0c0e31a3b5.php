

<?php $__env->startSection('title', 'Abrir Caja'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Abrir Caja</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4>Abrir Caja</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('cajas.store', ['id' => $id])); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <input type="hidden" name="sucursal_id" value="<?php echo e($id); ?>">


                            <div class="form-group">
                                <label for="fecha_apertura">Fecha Apertura</label>
                                <input type="datetime-local" name="fecha_apertura" id="fecha_apertura" class="form-control"
                                    value="<?php echo e(old('fecha_apertura', now()->format('Y-m-d\TH:i'))); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="monto_inicial">Monto Inicial</label>
                                <input type="number" name="monto_inicial" id="monto_inicial" class="form-control"
                                    step="0.01" required>
                            </div>

                            <div class="form-group">
                                <label for="id_user">Usuario</label>
                                <select name="id_user" id="id_user" class="form-control" required>
                                    <option value="">Selecciona un usuario</option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($user->id); ?>"
                                            <?php echo e(old('id_user', $loggedUser->id) == $user->id ? 'selected' : ''); ?>>
                                            <?php echo e($user->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success btn-lg w-100">Abrir Caja</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/cajas/create.blade.php ENDPATH**/ ?>