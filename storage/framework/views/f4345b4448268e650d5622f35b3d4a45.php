

<?php $__env->startSection('title', 'Solicitudes de Trabajo'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Solicitudes de Trabajo</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="mb-3 text-right">
            <a href="<?php echo e(route('solicitudes.create')); ?>" class="btn btn-gradient-primary btn-lg">
                <i class="fas fa-plus-circle"></i> Nueva Solicitud
            </a>
        </div>

        <div class="card shadow-lg border-0" style="border-radius: 15px;">
            <div class="card-header bg-gradient-blue text-white"
                style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h3 class="card-title"><i class="fas fa-file-alt"></i> Solicitudes Registradas</h3>
            </div>
            <div class="card-body" style="background: #f8f9fa;">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="solicitudesTable">
                        <thead class="linear-gradient">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>CI</th>
                                <th>Celular</th>
                                <th>CV</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $solicitudes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="animated fadeIn">
                                    <td><?php echo e($s->id); ?></td>
                                    <td><?php echo e($s->nombre); ?></td>
                                    <td><?php echo e($s->ci); ?></td>
                                    <td><?php echo e($s->celular); ?></td>
                                    <td>
                                        <?php if($s->cv_pdf): ?>
                                            <a href="<?php echo e(asset('storage/' . $s->cv_pdf)); ?>" target="_blank">Ver CV</a>
                                        <?php else: ?>
                                            Sin archivo
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-warning" href="<?php echo e(route('solicitudes.edit', $s->id)); ?>">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('solicitudes.destroy', $s->id)); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('¿Eliminar esta solicitud?')">
                                                <i class="fa fa-fw fa-trash"></i>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#solicitudesTable').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json'
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/solicitudes/index.blade.php ENDPATH**/ ?>