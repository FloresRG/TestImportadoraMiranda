

<?php $__env->startSection('title', 'Editar Caja'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Editar Caja</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-dark">
                        <h4>Formulario de Edición de Caja</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('cajas.updateEdit', ['caja' => $caja->id, 'id' => $id])); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha_apertura">Fecha Apertura</label>
                                        <input type="datetime-local" name="fecha_apertura" id="fecha_apertura"
                                            class="form-control" 
                                            value="<?php echo e(old('fecha_apertura', $caja->fecha_apertura->format('Y-m-d\TH:i'))); ?>"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_user">Usuario Apertura</label>
                                        <select name="id_user" id="id_user" class="form-control" required>
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($user->id); ?>"
                                                    <?php echo e(old('id_user', $caja->id_user) == $user->id ? 'selected' : ''); ?>>
                                                    <?php echo e($user->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="monto_inicial">Monto Inicial</label>
                                        <input type="number" name="monto_inicial" id="monto_inicial" class="form-control"
                                            value="<?php echo e(old('monto_inicial', $caja->monto_inicial)); ?>" step="0.01"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="efectivo_inicial">Efectivo Inicial</label>
                                        <input type="number" name="efectivo_inicial" id="efectivo_inicial"
                                            class="form-control"
                                            value="<?php echo e(old('efectivo_inicial', $caja->efectivo_inicial)); ?>" step="0.01"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="qr_inicial">QR Inicial</label>
                                        <input type="number" name="qr_inicial" id="qr_inicial" class="form-control"
                                            value="<?php echo e(old('qr_inicial', $caja->qr_inicial)); ?>" step="0.01" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Campo oculto para mantener la relación con la sucursal -->
                            <input type="hidden" name="sucursal_id" value="<?php echo e($id); ?>">

                            <div class="form-group text-center mt-3">
                                <button type="submit" class="btn btn-info btn-lg w-100">Guardar Edición</button>
                            </div>
                            <div class="form-group text-center">
                                <a href="<?php echo e(route('cajas.index', ['id' => $id])); ?>" 
                                    class="btn btn-secondary w-100">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/cajas/edit-caja.blade.php ENDPATH**/ ?>