

<?php $__env->startSection('template_title'); ?>
    Cupos
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <?php echo e(__('Cupos')); ?>

                            </span>
                            <div class="float-right">
                                <a href="<?php echo e(route('cupos.create')); ?>" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    <?php echo e(__('Create New')); ?>

                                </a>
                            </div>
                        </div>
                    </div>

                    <?php if($message = Session::get('success')): ?>
                        <div class="alert alert-success m-4">
                            <p><?php echo e($message); ?></p>
                        </div>
                    <?php endif; ?>

                    <!-- Tabla con DataTables -->
                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table id="cupos-table" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Codigo</th>
                                        <th>Estado</th>
                                        <th>FEHCA Y HORA DE ACTIVACION</th>
                                        <th>FEHCA Y HORA DE DESACTIVACION</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $cupos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cupo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($cupo->id); ?></td>
                                            <td><?php echo e($cupo->codigo); ?></td>
                                            <td>
                                                <?php
                                                    $estadoClass = $cupo->estado == 'Inactivo' ? 'text-danger' : 'text-success';
                                                    $estadoLabel = $cupo->estado == 'Inactivo' ? 'Inactivo' : 'Activo';
                                                ?>
                                                <span class="<?php echo e($estadoClass); ?>">
                                                    <?php echo e($estadoLabel); ?>

                                                </span>
                                            </td>
                                            <td><?php echo e($cupo->fecha_inicio ? $cupo->fecha_inicio->format('d/m/Y H:i') : 'N/A'); ?></td>
                                            <td><?php echo e($cupo->fecha_fin ? $cupo->fecha_fin->format('d/m/Y H:i') : 'N/A'); ?></td>
                                            <td>
                                                <form action="<?php echo e(route('cupos.destroy', $cupo->id)); ?>" method="POST">
                                                    <a class="btn btn-sm btn-primary" href="<?php echo e(route('cupos.show', $cupo->id)); ?>">
                                                        <i class="fa fa-fw fa-eye"></i> <?php echo e(__('Show')); ?>

                                                    </a>
                                                    <a class="btn btn-sm btn-success" href="<?php echo e(route('cupos.edit', $cupo->id)); ?>">
                                                        <i class="fa fa-fw fa-edit"></i> <?php echo e(__('Edit')); ?>

                                                    </a>
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;">
                                                        <i class="fa fa-fw fa-trash"></i> <?php echo e(__('Delete')); ?>

                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function() {
            $('#cupos-table').DataTable({
                processing: true,
                serverSide: false,  // No es necesario hacer AJAX porque los datos se cargan al inicio
                paging: true,       // Habilitar paginación
                searching: true,    // Habilitar búsqueda
                lengthChange: true, // Habilitar cambiar número de filas por página
                ordering: true,     // Habilitar ordenamiento de columnas
                pageLength: 10,     // Número de registros por página
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/cupo/index.blade.php ENDPATH**/ ?>