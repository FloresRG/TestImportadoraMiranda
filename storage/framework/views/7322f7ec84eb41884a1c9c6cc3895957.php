

<?php $__env->startSection('title', 'Panel de Administración'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Sucursales</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php if(session()->has('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session()->get('success')); ?>

    </div>
<?php endif; ?>

<div class="container">
    <h2>Sucursales</h2>
    <div class="row">
        <?php $__currentLoopData = $sucursales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sucursal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 mb-4">
                
                <?php if (isset($component)) { $__componentOriginalf0f47c4e1ce2217dc0ca74e5a14b492e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf0f47c4e1ce2217dc0ca74e5a14b492e = $attributes; } ?>
<?php $component = JeroenNoten\LaravelAdminLte\View\Components\Widget\ProfileWidget::resolve(['name' => ''.e($sucursal->nombre).'','desc' => 'Sucursal','img' => 'https://picsum.photos/id/'.e($loop->index + 1).'/100','layoutType' => 'classic'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('adminlte-profile-widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\JeroenNoten\LaravelAdminLte\View\Components\Widget\ProfileWidget::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'elevation-4']); ?>

                    
                    <?php if (isset($component)) { $__componentOriginal9caa3f4000781890929582b9937acd99 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9caa3f4000781890929582b9937acd99 = $attributes; } ?>
<?php $component = JeroenNoten\LaravelAdminLte\View\Components\Widget\ProfileRowItem::resolve(['title' => 'Direrccion','text' => ''.e($sucursal->direccion ?? 'Ubicación no disponible').''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('adminlte-profile-row-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\JeroenNoten\LaravelAdminLte\View\Components\Widget\ProfileRowItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9caa3f4000781890929582b9937acd99)): ?>
<?php $attributes = $__attributesOriginal9caa3f4000781890929582b9937acd99; ?>
<?php unset($__attributesOriginal9caa3f4000781890929582b9937acd99); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9caa3f4000781890929582b9937acd99)): ?>
<?php $component = $__componentOriginal9caa3f4000781890929582b9937acd99; ?>
<?php unset($__componentOriginal9caa3f4000781890929582b9937acd99); ?>
<?php endif; ?>

                    
                    <?php if (isset($component)) { $__componentOriginal9caa3f4000781890929582b9937acd99 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9caa3f4000781890929582b9937acd99 = $attributes; } ?>
<?php $component = JeroenNoten\LaravelAdminLte\View\Components\Widget\ProfileRowItem::resolve(['title' => 'Cantidad de productos ','text' => ''.e($sucursal->inventarios->sum('cantidad')).' productos disponibles'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('adminlte-profile-row-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\JeroenNoten\LaravelAdminLte\View\Components\Widget\ProfileRowItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9caa3f4000781890929582b9937acd99)): ?>
<?php $attributes = $__attributesOriginal9caa3f4000781890929582b9937acd99; ?>
<?php unset($__attributesOriginal9caa3f4000781890929582b9937acd99); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9caa3f4000781890929582b9937acd99)): ?>
<?php $component = $__componentOriginal9caa3f4000781890929582b9937acd99; ?>
<?php unset($__componentOriginal9caa3f4000781890929582b9937acd99); ?>
<?php endif; ?>

                    
                    <?php if (isset($component)) { $__componentOriginal9caa3f4000781890929582b9937acd99 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9caa3f4000781890929582b9937acd99 = $attributes; } ?>
<?php $component = JeroenNoten\LaravelAdminLte\View\Components\Widget\ProfileRowItem::resolve(['title' => 'Contactar'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('adminlte-profile-row-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\JeroenNoten\LaravelAdminLte\View\Components\Widget\ProfileRowItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-center border-bottom']); ?>
                        <button class="btn btn-red btn-sm">Contactar</button>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9caa3f4000781890929582b9937acd99)): ?>
<?php $attributes = $__attributesOriginal9caa3f4000781890929582b9937acd99; ?>
<?php unset($__attributesOriginal9caa3f4000781890929582b9937acd99); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9caa3f4000781890929582b9937acd99)): ?>
<?php $component = $__componentOriginal9caa3f4000781890929582b9937acd99; ?>
<?php unset($__componentOriginal9caa3f4000781890929582b9937acd99); ?>
<?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('control.productos')): ?>
                    <?php if (isset($component)) { $__componentOriginal9caa3f4000781890929582b9937acd99 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9caa3f4000781890929582b9937acd99 = $attributes; } ?>
<?php $component = JeroenNoten\LaravelAdminLte\View\Components\Widget\ProfileRowItem::resolve(['title' => 'Ver Productos','url' => ''.e(route('control.productos', $sucursal->id)).'','icon' => 'fas fa-box','size' => '6'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('adminlte-profile-row-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\JeroenNoten\LaravelAdminLte\View\Components\Widget\ProfileRowItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9caa3f4000781890929582b9937acd99)): ?>
<?php $attributes = $__attributesOriginal9caa3f4000781890929582b9937acd99; ?>
<?php unset($__attributesOriginal9caa3f4000781890929582b9937acd99); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9caa3f4000781890929582b9937acd99)): ?>
<?php $component = $__componentOriginal9caa3f4000781890929582b9937acd99; ?>
<?php unset($__componentOriginal9caa3f4000781890929582b9937acd99); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal9caa3f4000781890929582b9937acd99 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9caa3f4000781890929582b9937acd99 = $attributes; } ?>
<?php $component = JeroenNoten\LaravelAdminLte\View\Components\Widget\ProfileRowItem::resolve(['title' => 'Generar Reporte','url' => ''.e(route('sucursal.reporte.productos', $sucursal->id)).'','icon' => 'fas fa-file-pdf','size' => '6'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('adminlte-profile-row-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\JeroenNoten\LaravelAdminLte\View\Components\Widget\ProfileRowItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9caa3f4000781890929582b9937acd99)): ?>
<?php $attributes = $__attributesOriginal9caa3f4000781890929582b9937acd99; ?>
<?php unset($__attributesOriginal9caa3f4000781890929582b9937acd99); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9caa3f4000781890929582b9937acd99)): ?>
<?php $component = $__componentOriginal9caa3f4000781890929582b9937acd99; ?>
<?php unset($__componentOriginal9caa3f4000781890929582b9937acd99); ?>
<?php endif; ?>

                        <?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf0f47c4e1ce2217dc0ca74e5a14b492e)): ?>
<?php $attributes = $__attributesOriginalf0f47c4e1ce2217dc0ca74e5a14b492e; ?>
<?php unset($__attributesOriginalf0f47c4e1ce2217dc0ca74e5a14b492e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf0f47c4e1ce2217dc0ca74e5a14b492e)): ?>
<?php $component = $__componentOriginalf0f47c4e1ce2217dc0ca74e5a14b492e; ?>
<?php unset($__componentOriginalf0f47c4e1ce2217dc0ca74e5a14b492e); ?>
<?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        /* Personaliza tus estilos aquí si es necesario */
        .card {
            margin-bottom: 20px; /* Espaciado entre tarjetas */
            transition: transform 0.2s; /* Animación al pasar el mouse */
        }
        .card:hover {
            transform: scale(1.05); /* Efecto de zoom */
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Puedes agregar scripts aquí si es necesario
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/control/index.blade.php ENDPATH**/ ?>