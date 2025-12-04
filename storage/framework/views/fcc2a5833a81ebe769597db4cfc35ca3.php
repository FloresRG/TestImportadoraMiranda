<?php $__env->startSection('title', 'Análisis Predictivo'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="text-center" style="font-family: 'Cinzel', serif; font-size: 3em; color: #8E44AD;">
        Análisis Predictivo
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row mb-4">
        <div class="col-md-4">
            <form method="GET" action="<?php echo e(route('analisis.index')); ?>" id="form-producto-filtro">
                <div class="form-group">
                    <label for="search_input">Buscar Producto:</label>
                    <div class="input-group">
                        
                        
                        <input type="text" class="form-control" id="search_input" placeholder="Escribe para buscar..."
                            autocomplete="off"
                            value="<?php echo e($productoId && $productos->first() ? $productos->first()->nombre : ''); ?>">

                        
                        <input type="hidden" name="producto_id" id="producto_id_hidden" value="<?php echo e($productoId ?? ''); ?>">

                        <div class="input-group-append">
                            
                            <button class="btn btn-default" type="button" id="clear_search"
                                style="display: <?php echo e($productoId ? 'inline-block' : 'none'); ?>;">X</button>
                        </div>
                    </div>
                </div>
            </form>

            
            
            <div id="search_results" class="list-group position-absolute w-25"
                style="z-index: 1000; min-width: 300px; display: none;">
                
            </div>

            <?php if($productoId): ?>
                <div class="alert alert-success mt-2">
                    Producto filtrado: **<?php echo e($productos->first()->nombre ?? 'N/A'); ?>**. Presiona 'X' para limpiar.
                </div>
            <?php endif; ?>

        </div>
    </div>

    <div class="row mb-4">
        <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4">
                <div class="card text-white bg-<?php echo e($data['color']); ?> mb-3">
                    <div class="card-header"><?php echo e($title); ?></div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e($data['titulo']); ?></h5>
                        <p class="card-text"><?php echo e($data['descripcion']); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php if($productoId): ?>
        <?php
            $productoSeleccionado = $productos->first();
            $demandaProyectada = array_sum(array_column($predicciones, 'yhat'));
        ?>

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        Información del Producto: <?php echo e($productoSeleccionado->nombre); ?>

                    </div>
                    <div class="card-body">
                        <p><strong>Total Vendido Hasta Ahora:</strong> <?php echo e($totalVendido); ?></p>
                        <p><strong>Demanda Proyectada Próximos 7 días:</strong> <?php echo e(round($demandaProyectada)); ?></p>

                        <?php
                            $ultimoError = \App\Models\Prediccion::where('producto_id', $productoSeleccionado->id)
                                ->orderByDesc('created_at')
                                ->value('error_promedio');
                        ?>

                        <?php if($ultimoError): ?>
                            <p><strong>Error Promedio MAE:</strong> <?php echo e($ultimoError); ?></p>
                        <?php endif; ?>
                        <h5>Ventas Último Mes:</h5>
                        <ul>
                            <?php if(count($ventasUltimoMes) > 0): ?>
                                <?php $__currentLoopData = $ventasUltimoMes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($venta->fecha); ?>: <?php echo e($venta->cantidad); ?> unidades</li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="alert alert-warning mt-2" role="alert" style="font-weight: 500;">
                                    ⚠️ Este producto no tiene datos actualizados de ventas recientes.
                                </div>
                            <?php endif; ?>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-info">
                <div class="card-header bg-info text-white">
                    Gráfico de Ventas
                </div>
                <div class="card-body">
                    <canvas id="graficoVentas"></canvas>
                </div>
            </div>
        </div>
    </div>

    <?php if(count($alertas) > 0): ?>
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <h5>Alerta:</h5>
                    <ul>
                        <?php $__currentLoopData = $alertas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alerta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($alerta); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // ---------------------- BUSCADOR ----------------------
        $(document).ready(function() {
            let searchTimeout;
            const searchInput = $('#search_input');
            const searchResults = $('#search_results');
            const productoIdHidden = $('#producto_id_hidden');
            const clearButton = $('#clear_search');

            $(document).on('click', function(e) {
                if (!$(e.target).closest('#search_input, #search_results').length) {
                    searchResults.empty().hide();
                }
            });

            searchInput.on('keyup', function() {
                const term = $(this).val();
                clearTimeout(searchTimeout);

                if (term.length < 2) {
                    searchResults.empty().hide();
                    return;
                }

                searchTimeout = setTimeout(function() {
                    $.ajax({
                        url: "<?php echo e(route('analisis.searchProductos')); ?>",
                        method: 'GET',
                        data: {
                            term: term
                        },
                        success: function(data) {
                            searchResults.empty();
                            if (data.length > 0) {
                                let html = '';
                                $.each(data, function(index, producto) {
                                    html += `<a href="#" class="list-group-item list-group-item-action"
                                            data-id="${producto.id}" data-nombre="${producto.nombre}">
                                            ${producto.nombre}
                                         </a>`;
                                });
                                searchResults.html(html).show();
                            } else {
                                searchResults.html(
                                    '<a href="#" class="list-group-item list-group-item-secondary disabled">No se encontraron productos</a>'
                                ).show();
                            }
                        }
                    });
                }, 300);
            });

            searchResults.on('click', 'a.list-group-item-action', function(e) {
                e.preventDefault();
                const selectedId = $(this).data('id');
                const selectedName = $(this).data('nombre');

                productoIdHidden.val(selectedId);
                searchInput.val(selectedName);
                searchResults.empty().hide();
                clearButton.show();
                $('#form-producto-filtro').submit();
            });

            clearButton.on('click', function() {
                productoIdHidden.val('');
                searchInput.val('');
                clearButton.hide();
                $('#form-producto-filtro').submit();
            });
        });
    </script>

    <script>
        // ---------------------- ALERTAS ----------------------
        <?php if(count($alertas) > 0): ?>
            <?php $__currentLoopData = $alertas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alerta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                Swal.fire({
                    icon: 'warning',
                    title: 'Alerta',
                    text: "<?php echo e($alerta); ?>",
                    timer: 5000,
                    timerProgressBar: true,
                });
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </script>

    <script>
        // ---------------------- GRÁFICOS ----------------------
        const ctxVentas = document.getElementById('graficoVentas').getContext('2d');

        <?php if($productoId): ?>
            // ----------- CUANDO SE FILTRA UN PRODUCTO -----------
            const ventasHistoricas = <?php echo json_encode($ventasHistoricasJS, 15, 512) ?>;
            const predicciones = <?php echo json_encode($prediccionesJS, 15, 512) ?>;

            const fechasHistoricas = ventasHistoricas.map(v => v.fecha);
            const cantidadesHistoricas = ventasHistoricas.map(v => v.cantidad);
            const fechasPred = predicciones.map(p => p.fecha);
            const cantidadesPred = predicciones.map(p => p.yhat);

            // 📈 GRAFICO HISTÓRICO
            new Chart(ctxVentas, {
                type: 'line',
                data: {
                    labels: fechasHistoricas,
                    datasets: [{
                        label: "Histórico de Ventas",
                        data: cantidadesHistoricas,
                        borderColor: "#3498db",
                        backgroundColor: "rgba(52, 152, 219, 0.2)",
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Histórico de Ventas del Producto'
                        }
                    }
                }
            });

            // 📊 NUEVO GRAFICO SOLO DE PREDICCIÓN
            // 📊 NUEVO GRÁFICO SOLO DE PREDICCIÓN CON INTERVALO DE CONFIANZA
            const predContainer = document.createElement('div');
            predContainer.classList.add('card', 'border-danger', 'mt-4');
            predContainer.innerHTML = `
<div class="card-header bg-danger text-white">Predicción Próximos 7 Días</div>
<div class="card-body"><canvas id="graficoPrediccion"></canvas></div>
`;
            document.querySelector('.card.border-info').after(predContainer);

            const ctxPred = document.getElementById('graficoPrediccion').getContext('2d');

            // Extraer valores del JSON
            const yhat = predicciones.map(p => p.yhat);
            const yhatLower = predicciones.map(p => p.yhat_lower);
            const yhatUpper = predicciones.map(p => p.yhat_upper);

            new Chart(ctxPred, {
                type: 'line',
                data: {
                    labels: fechasPred,
                    datasets: [{
                        label: "Predicción",
                        data: yhat,
                        borderColor: "#e74c3c",
                        borderWidth: 2,
                        tension: 0.3,
                        fill: false
                    }, ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Proyección de Ventas (7 días)'
                        },
                        legend: {
                            display: true
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        <?php else: ?>
            // ----------- CUANDO NO HAY FILTRO (3 PRODUCTOS) -----------
            const ventasHistoricasJS = <?php echo json_encode($ventasHistoricasJS, 15, 512) ?>;
            const prediccionesJS = <?php echo json_encode($prediccionesJS, 15, 512) ?>;

            // 📈 GRAFICO HISTÓRICO
            const datasetsHist = [];
            let allDates = new Set();
            Object.values(ventasHistoricasJS).forEach(vs => vs.forEach(v => allDates.add(v.fecha)));
            const labelsHist = Array.from(allDates).sort();

            Object.keys(ventasHistoricasJS).forEach((nombre, i) => {
                const map = {};
                ventasHistoricasJS[nombre].forEach(v => map[v.fecha] = v.cantidad);
                const data = labelsHist.map(f => map[f] ?? null);
                datasetsHist.push({
                    label: `${nombre} - Histórico`,
                    data: data,
                    borderColor: `hsl(${i * 90},70%,50%)`,
                    backgroundColor: `hsla(${i * 90},70%,50%,0.2)`,
                    tension: 0.3
                });
            });

            new Chart(ctxVentas, {
                type: 'line',
                data: {
                    labels: labelsHist,
                    datasets: datasetsHist
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Historico de Ventas (productos destacados)'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // 📊 GRAFICO DE PREDICCIONES SEPARADO
            const predContainer = document.createElement('div');
            predContainer.classList.add('card', 'border-danger', 'mt-4');
            predContainer.innerHTML = `
            <div class="card-header bg-danger text-white">Predicciones Próximos 7 Días</div>
            <div class="card-body"><canvas id="graficoPrediccion"></canvas></div>
        `;
            document.querySelector('.card.border-info').after(predContainer);

            const ctxPred = document.getElementById('graficoPrediccion').getContext('2d');
            const datasetsPred = [];
            let allDatesPred = new Set();
            Object.values(prediccionesJS).forEach(vs => vs.forEach(p => allDatesPred.add(p.fecha)));
            const labelsPred = Array.from(allDatesPred).sort();

            Object.keys(prediccionesJS).forEach((nombre, i) => {
                const map = {};
                prediccionesJS[nombre].forEach(p => map[p.fecha] = p.yhat);
                const data = labelsPred.map(f => map[f] ?? null);
                datasetsPred.push({
                    label: `${nombre} - Predicción`,
                    data: data,
                    borderColor: `hsl(${i * 90},70%,40%)`,
                    backgroundColor: `hsla(${i * 90},70%,40%,0.1)`,

                    tension: 0.3
                });
            });

            new Chart(ctxPred, {
                type: 'line',
                data: {
                    labels: labelsPred,
                    datasets: datasetsPred
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Predicción de Ventas (Top 3 Productos)'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\TESTIMPORTADORA\TestImportadoraMiranda\resources\views/analisis_predictivo/index.blade.php ENDPATH**/ ?>