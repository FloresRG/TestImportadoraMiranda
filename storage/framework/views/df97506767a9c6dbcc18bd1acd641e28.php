

<?php $__env->startSection('title', 'Carpetas'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Carpetas</h1>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <form action="<?php echo e(route('carpetas.index')); ?>" method="GET" class="form-inline">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Buscar por descripción..." value="<?php echo e(request('search')); ?>">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <?php if($rol === 'admin' && request()->filled('sucursal_id')): ?>
                <a href="<?php echo e(route('carpetas.index')); ?>" class="btn btn-secondary mb-3">
                    <i class="fas fa-arrow-left"></i> Volver a sucursales
                </a>
            <?php endif; ?>

            <!-- Formulario para crear nueva carpeta -->
            <div class="card card-primary mb-4">
                <div class="card-header">
                    <h3 class="card-title">Nueva Carpeta</h3>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('carpetas.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sucursal_id">Sucursal</label>

                                    <?php if($rol === 'admin' && request()->filled('sucursal_id')): ?>
                                        <input type="hidden" name="sucursal_id" value="<?php echo e(request('sucursal_id')); ?>">
                                        <input type="text" class="form-control"
                                            value="<?php echo e($sucursales->firstWhere('id', request('sucursal_id'))?->nombre); ?>"
                                            disabled>
                                    <?php elseif($rol === 'admin'): ?>
                                        <select class="form-control" name="sucursal_id">
                                            <?php $__currentLoopData = $sucursales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sucursal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($sucursal->id); ?>"><?php echo e($sucursal->nombre); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    <?php else: ?>
                                        <input type="hidden" name="sucursal_id" value="<?php echo e($sucursalUsuario->id); ?>">
                                        <input type="text" class="form-control" value="<?php echo e($sucursalUsuario->nombre); ?>"
                                            disabled>
                                    <?php endif; ?>

                                    <?php $__errorArgs = ['sucursal_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        id="descripcion" name="descripcion" required>
                                    <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <?php
                                    use Carbon\Carbon;
                                ?>
                                <div class="form-group">
                                    <label for="fecha">Fecha y hora</label>
                                    <input type="datetime-local" class="form-control <?php $__errorArgs = ['fecha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        id="fecha" name="fecha"
                                        value="<?php echo e(old('fecha', \Carbon\Carbon::now()->format('Y-m-d\TH:i'))); ?>" required>
                                    <?php $__errorArgs = ['fecha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-plus"></i> Crear
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <?php $__currentLoopData = $carpetas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carpeta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <h1 class="card-title text-primary text-uppercase mb-4" style="font-size: 2rem;">
                                    <?php echo e($carpeta->descripcion); ?></h1>


                                <div class="text-center mb-3">
                                    <img src="<?php echo e(asset('images/carpeta.png')); ?>" alt="Carpeta" class="img-fluid"
                                        style="max-height: 100px;">
                                </div>
                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar"></i>
                                        <?php echo e(\Carbon\Carbon::parse($carpeta->fecha)->format('d/m/Y H:i')); ?>


                                    </small>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="fas fa-building"></i>
                                        Sucursal: <?php echo e($carpeta->sucursal->nombre ?? 'No definida'); ?>

                                    </small>
                                </p>

                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="fas fa-images"></i> <?php echo e($carpeta->capturas->count()); ?> capturas
                                    </small>
                                </p>
                                <div class="btn-group">
                                    <a href="<?php echo e(route('carpetas.show', $carpeta)); ?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#addCapturaModal" data-carpeta-id="<?php echo e($carpeta->id); ?>">
                                        <i class="fas fa-camera"></i> Agregar
                                    </button>
                                    <a href="<?php echo e(route('carpetas.edit', $carpeta)); ?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="<?php echo e(route('carpetas.destroy', $carpeta)); ?>" method="POST"
                                        class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <!--<button type="submit" class="btn btn-danger btn-sm"-->
                                        <!--   onclick="return confirm('¿Estás seguro de eliminar esta carpeta?')">-->
                                        <!--   <i class="fas fa-trash"></i> Eliminar-->
                                        <!--</button>-->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if($carpetas->isEmpty()): ?>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> No se encontraron carpetas que coincidan con la búsqueda.
                </div>
            <?php endif; ?>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-center">
               <?php echo e($carpetas->appends(request()->except('page'))->links()); ?>

            </div>
        </div>
    </div>

    <!-- Modal para agregar capturas -->
    <div class="modal fade" id="addCapturaModal" tabindex="-1" role="dialog" aria-labelledby="addCapturaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCapturaModalLabel">Agregar Capturas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('capturas.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" name="carpeta_id" id="carpeta_id">
                        <div class="form-group">
                            <label for="foto_original">Seleccionar Fotos</label>
                            <input type="file" class="form-control-file <?php $__errorArgs = ['foto_original'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="foto_original" name="foto_original[]" multiple accept="image/*">
                            <?php $__errorArgs = ['foto_original'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <small class="form-text text-muted">Puedes seleccionar múltiples fotos.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar Capturas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .card-primary.card-outline {
            border-top: 3px solid #007bff;
        }

        .btn-group {
            gap: 5px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        // Mostrar rol en consola
        console.log("ROL DEL USUARIO: <?php echo e($rol); ?>");
        console.log("SUCURSAL DEL USUARIO: <?php echo e($sucursalUsuario); ?>");
        // Script para el modal de capturas
        $('#addCapturaModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var carpetaId = button.data('carpeta-id');
            var modal = $(this);
            modal.find('#carpeta_id').val(carpetaId);
        });

        // Script para establecer la fecha actual en el campo de fecha
        $(document).ready(function() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
            $('#fecha').val(formattedDateTime);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/carpetas/index.blade.php ENDPATH**/ ?>