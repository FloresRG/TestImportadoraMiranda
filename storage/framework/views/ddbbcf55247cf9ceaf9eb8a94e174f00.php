<!-- resources/views/informes/pagos-mensuales.blade.php -->


<?php $__env->startSection('title', 'Pagos Mensuales'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-calendar-alt mr-2"></i>Pagos Mensuales</h1>
        <a href="<?php echo e(route('informes.index')); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i>Volver
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <form action="<?php echo e(route('informes.pagos-mensuales')); ?>" method="GET" class="form-inline">
            <div class="form-group mr-3">
                <label for="mes" class="mr-2">Mes:</label>
                <select name="mes" id="mes" class="form-control">
                    <?php for($i = 1; $i <= 12; $i++): ?>
                        <option value="<?php echo e($i); ?>" <?php echo e($mes == $i ? 'selected' : ''); ?>>
                            <?php echo e(date('F', mktime(0, 0, 0, $i, 1))); ?>

                        </option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group mr-3">
                <label for="anio" class="mr-2">Año:</label>
                <select name="anio" id="anio" class="form-control">
                    <?php for($i = date('Y'); $i >= date('Y')-5; $i--): ?>
                        <option value="<?php echo e($i); ?>" <?php echo e($anio == $i ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search mr-1"></i>Consultar
            </button>
        </form>
    </div>
    <div class="card-body">
        <h3 class="text-center mb-4">Informe de Pagos: <?php echo e(date('F Y', mktime(0, 0, 0, $mes, 1, $anio))); ?></h3>
        
        <?php if($pagos->isEmpty()): ?>
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle mr-2"></i>No hay pagos registrados para este mes.
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-md-8">
                    <canvas id="graficoMensual" height="300"></canvas>
                </div>
                <div class="col-md-4">
                    <div class="info-box bg-success">
                        <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total del Mes</span>
                            <span class="info-box-number">$<?php echo e(number_format($totalMes, 2)); ?></span>
                        </div>
                    </div>
                    
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="fas fa-calendar-check"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Días con Pagos</span>
                            <span class="info-box-number"><?php echo e($pagosPorDia->count()); ?></span>
                        </div>
                    </div>
                    
                    <div class="info-box bg-warning">
                        <span class="info-box-icon"><i class="fas fa-calculator"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Promedio Diario</span>
                            <span class="info-box-number">
                                $<?php echo e(number_format($pagosPorDia->count() > 0 ? $totalMes / $pagosPorDia->count() : 0, 2)); ?>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <h4 class="mt-4">Detalle de Pagos por Día</h4>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Fecha</th>
                            <th>Cantidad de Pagos</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $pagosPorDia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dia => $pagosDia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($dia); ?></td>
                            <td><?php echo e($pagosDia->count()); ?></td>
                            <td>$<?php echo e(number_format($pagosDia->sum('monto_pago'), 2)); ?></td>
                            <td>
                                <a href="<?php echo e(route('informes.pagos-diarios', ['fecha' => date('Y-m-d', strtotime($dia))])); ?>" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye mr-1"></i>Ver detalle
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            
            
            <!-- En resources/views/informes/pagos-mensuales.blade.php, modifica la sección de botones -->

            



        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Solo crear gráfico si hay datos
        <?php if(count($datosDiarios) > 0): ?>
        const ctx = document.getElementById('graficoMensual').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_column($datosDiarios, 'dia')); ?>,
                datasets: [{
                    label: 'Total de pagos por día ($)',
                    data: <?php echo json_encode(array_column($datosDiarios, 'total')); ?>,
                    backgroundColor: 'rgba(40, 167, 69, 0.6)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value;
                            }
                        }
                    }
                }
            }
        });
        <?php endif; ?>
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/informes/pagos-mensuales.blade.php ENDPATH**/ ?>