

<?php $__env->startSection('title', 'Marcas'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Marcas</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('marcas.create')): ?>
            <div class="mb-3 text-right">
                <a href="<?php echo e(route('marcas.create')); ?>" class="btn btn-gradient-primary btn-lg">
                    <i class="fas fa-plus-circle"></i> Agregar Marca
                </a>
            </div>
        <?php endif; ?>

        <div class="card shadow-lg border-0" style="border-radius: 15px;">
            <div class="card-header bg-gradient-blue text-white"
                style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h3 class="card-title"><i class="fas fa-tags"></i> Marcas Registradas</h3>
            </div>
            <div class="card-body" style="background: #f8f9fa;">
                <!-- Contenedor de tabla responsiva -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="marcasTable">
                        <thead class="linear-gradient">
                            <tr>
                                <th>No</th>
                                <th>Marca</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $marcas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="animated fadeIn">
                                    <td><?php echo e(++$i); ?></td>
                                    <td><?php echo e($marca->marca); ?></td>
                                    <td class="text-center">
                                        <form action="<?php echo e(route('marcas.destroy', $marca->id)); ?>" method="POST"
                                            style="display:inline;" id="delete-form-<?php echo e($marca->id); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('marcas.show')): ?>
                                                <a class="btn btn-gradient-success btn-sm"
                                                    href="<?php echo e(route('marcas.show', $marca->id)); ?>" title="Ver marca"
                                                    style="border-radius: 5px;">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('marcas.edit')): ?>
                                                <a class="btn btn-gradient-success btn-sm"
                                                    href="<?php echo e(route('marcas.edit', $marca->id)); ?>" title="Editar marca"
                                                    style="border-radius: 5px;">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('marcas.destroy')): ?>
                                                <button type="button" class="btn btn-gradient-danger btn-sm"
                                                    onclick="confirmDelete(<?php echo e($marca->id); ?>)" title="Eliminar marca"
                                                    style="border-radius: 5px;">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            <?php endif; ?>
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

    <script>
        function confirmDelete(marcaId) {
            Swal.fire({
                title: '¿Está seguro?',
                text: '¡No podrás recuperar esta marca después de eliminarla!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminarla',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + marcaId).submit();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            $('#marcasTable').DataTable({
                responsive: true,
                paging: true,
                searching: true,
                ordering: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json'
                }
            });
        });
    </script>

    <!-- SweetAlert2 para éxito -->
    <?php if(session('success')): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: '<?php echo e(session('success')); ?>',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            });
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/marca/index.blade.php ENDPATH**/ ?>