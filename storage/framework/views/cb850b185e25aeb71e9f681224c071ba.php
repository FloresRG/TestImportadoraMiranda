

<?php $__env->startSection('title', 'Sucursales'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Sucursales</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sucursales.create')): ?>
            <div class="mb-3 text-right">
                <a href="<?php echo e(route('sucursales.create')); ?>" class="btn btn-gradient-primary btn-lg">
                    <i class="fas fa-plus-circle"></i> Agregar Sucursal
                </a>
            </div>
        <?php endif; ?>

        <div class="card shadow-lg border-0" style="border-radius: 15px;">
            <div class="card-header bg-gradient-blue text-white"
                style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h3 class="card-title"><i class="fas fa-store"></i> Sucursales Registradas</h3>
            </div>
            <div class="card-body" style="background: #f8f9fa;">
                <!-- Contenedor de tabla responsiva -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="sucursalesTable">
                        <thead class="linear-gradient">
                            <tr>
                                <th>No</th>
                                <th>Logo</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Celular</th>
                                <th>Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $sucursales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sucursale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="animated fadeIn">
                                    <td><?php echo e(++$i); ?></td>
                                    <td>
                                        <?php if($sucursale->logo): ?>
                                            <img src="<?php echo e(asset('storage/' . $sucursale->logo)); ?>" alt="Logo"
                                                class="img-fluid" style="max-width: 50px; height: auto;">
                                        <?php else: ?>
                                            <i class="fas fa-image" style="font-size: 24px;"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($sucursale->nombre); ?></td>
                                    <td><?php echo e($sucursale->direccion); ?></td>
                                    <td><?php echo e($sucursale->celular ?? 'No disponible'); ?></td>
                                    <td><?php echo e($sucursale->estado ?? 'No definido'); ?></td>
                                    <td class="text-center">
                                        <form action="<?php echo e(route('sucursales.destroy', $sucursale->id)); ?>" method="POST"
                                            style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sucursales.show')): ?>
                                                <a class="btn btn-gradient-success btn-sm"
                                                    href="<?php echo e(route('sucursales.show', $sucursale->id)); ?>" title="Ver sucursal"
                                                    style="border-radius: 5px;">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sucursales.edit')): ?>
                                                <a class="btn btn-gradient-success btn-sm"
                                                    href="<?php echo e(route('sucursales.edit', $sucursale->id)); ?>"
                                                    title="Editar sucursal" style="border-radius: 5px;">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sucursales.destroy')): ?>
                                                
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-gradient-danger btn-sm"
                                                    onclick="event.preventDefault(); confirm('¿Está seguro de eliminar?') ? this.closest('form').submit() : false;">
                                                    <i class="fa fa-fw fa-trash"></i>
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
        document.addEventListener('DOMContentLoaded', function() {
            $('#sucursalesTable').DataTable({
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

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/sucursale/index.blade.php ENDPATH**/ ?>