

<?php $__env->startSection('title', 'Registros de Productos en Mal Estado'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Lista de Productos en Mal Estado</h1>
    <a href="<?php echo e(route('prodregistromalestado.create')); ?>" class="btn btn-success mb-2">Crear Nuevo Registro</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead style="background-color:#007BFF; color:white;">
                    <tr>
                        <th>ID</th>

                        
                        <?php $__currentLoopData = ['De la Paz', 'Enviado', 'Extra1', 'Extra2', 'Extra3', 'Extra4', 'Extra5']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $check): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th class="rotate-header">
                                <div><?php echo e($check); ?></div>
                            </th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <th>Celular</th>
                        <th>Persona</th>
                        <th>Departamento</th>
                        <th>Producto</th>
                        <th>Estado</th>
                        <th>Descripción del Problema</th>
                        <th>Fecha Registro</th>
                        <th>Fecha Cambio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr
                            style="background-color: <?php echo e(['#FFEBEE', '#E8F5E9', '#E3F2FD', '#FFFDE7', '#F3E5F5', '#E0F7FA', '#FFF3E0'][$loop->index % 7]); ?>">
                            <td><?php echo e($registro->id); ?></td>

                            
                            <?php
                                $checkColors = [
                                    '#FF0000', // rojo intenso
                                    '#00CED1', // turquesa brillante
                                    '#1E90FF', // azul intenso
                                    '#32CD32', // verde intenso
                                    '#FFD700', // amarillo dorado
                                    '#9400D3', // violeta oscuro
                                    '#00BFFF', // azul cielo intenso
                                ];

                                $checkFields = [
                                    'de_la_paz',
                                    'enviado',
                                    'extra1',
                                    'extra2',
                                    'extra3',
                                    'extra4',
                                    'extra5',
                                ];
                            ?>

                            <?php $__currentLoopData = $checkFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $check): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td class="checkbox-cell">
                                    <div class="checkbox-container" style="--check-color: <?php echo e($checkColors[$index]); ?>;">
                                        <input type="checkbox" class="form-check-input toggle-check custom-checkbox"
                                            data-id="<?php echo e($registro->id); ?>" data-field="<?php echo e($check); ?>"
                                            <?php echo e($registro->$check ? 'checked' : ''); ?>

                                            id="check_<?php echo e($registro->id); ?>_<?php echo e($check); ?>">
                                        <label for="check_<?php echo e($registro->id); ?>_<?php echo e($check); ?>"
                                            class="checkbox-label"></label>
                                    </div>
                                </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <td><?php echo e($registro->celular); ?></td>
                            <td><?php echo e($registro->persona); ?></td>
                            <td><?php echo e($registro->departamento); ?></td>
                            <td><?php echo e($registro->producto->nombre ?? ''); ?></td>

                            
                            <td>
                                <select class="form-select estado-select" data-id="<?php echo e($registro->id); ?>">
                                    <option value="mal" <?php echo e($registro->estado == 'mal' ? 'selected' : ''); ?>

                                        style="color:red;">Mal Estado</option>
                                    <option value="bueno" <?php echo e($registro->estado == 'bueno' ? 'selected' : ''); ?>

                                        style="color:green;">Buen Estado</option>
                                </select>
                            </td>

                            
                            <td>
                                <input type="text" class="form-control edit-descripcion" data-id="<?php echo e($registro->id); ?>"
                                    value="<?php echo e($registro->descripcion_problema); ?>">
                            </td>

                            <td><?php echo e($registro->fecha_inscripcion); ?></td>
                            <td><?php echo e($registro->fecha_cambio_estado ?? '-'); ?></td>

                            <td>
                                <a href="<?php echo e(route('prodregistromalestado.show', $registro->id)); ?>"
                                    class="btn btn-info btn-sm">Ver</a>
                                <a href="<?php echo e(route('prodregistromalestado.edit', $registro->id)); ?>"
                                    class="btn btn-warning btn-sm">Editar</a>
                                <form action="<?php echo e(route('prodregistromalestado.destroy', $registro->id)); ?>" method="POST"
                                    class="d-inline">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            
            <div class="mt-2">
                <?php echo e($registros->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        /* Headers rotativos CORREGIDOS */
        .rotate-header {
            width: 60px;
            height: 80px;
            vertical-align: middle;
            padding: 0;
            position: relative;
            overflow: hidden;
        }

        .rotate-header div {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-90deg);
            transform-origin: center center;
            white-space: nowrap;
            font-size: 12px;
            font-weight: bold;
        }

        /* Contenedor de checkboxes */
        .checkbox-cell {
            width: 60px;
            padding: 10px 5px;
            vertical-align: middle;
        }

        .checkbox-container {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            width: 100%;
            height: 30px;
        }

        /* Checkboxes personalizados con colores */
        .custom-checkbox {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid var(--check-color);
            border-radius: 4px;
            background-color: white;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
            margin: 0;
        }

        .custom-checkbox:checked {
            background-color: var(--check-color);
            border-color: var(--check-color);
            box-shadow: 0 0 5px var(--check-color);
            transform: scale(1.1);
        }


        .custom-checkbox:checked::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 12px;
            /* tamaño del círculo */
            height: 12px;
            background-color: white;
            /* color del círculo */
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }


        .custom-checkbox:hover {
            transform: scale(1.15);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .custom-checkbox:focus {
            outline: 2px solid var(--check-color);
            outline-offset: 2px;
        }

        /* Efecto de ondas al hacer click */
        .checkbox-container::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background-color: var(--check-color);
            opacity: 0.3;
            transform: translate(-50%, -50%);
            transition: width 0.3s ease, height 0.3s ease;
            pointer-events: none;
        }

        .checkbox-container:active::after {
            width: 40px;
            height: 40px;
        }

        /* Mejoras generales de la tabla */
        .table {
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.1) !important;
            transition: background-color 0.2s ease;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .rotate-header {
                width: 50px;
                height: 70px;
            }

            .rotate-header div {
                font-size: 10px;
            }

            .checkbox-cell {
                width: 50px;
            }

            .custom-checkbox {
                width: 18px;
                height: 18px;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        // Toggle checkboxes en tiempo real con animación
        document.querySelectorAll('.toggle-check').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                // Añadir efecto visual durante la actualización
                this.style.opacity = '0.7';

                fetch(`/prodregistromalestado/${this.dataset.id}/toggle-check`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        },
                        body: JSON.stringify({
                            field: this.dataset.field,
                            value: this.checked ? 1 : 0
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Restaurar opacidad después de la actualización
                        this.style.opacity = '1';

                        // Opcional: mostrar notificación de éxito
                        console.log('Checkbox actualizado correctamente');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Revertir el checkbox en caso de error
                        this.checked = !this.checked;
                        this.style.opacity = '1';
                    });
            });
        });

        // Editar descripción en tiempo real con debounce
        document.querySelectorAll('.edit-descripcion').forEach(input => {
            let timeout;
            input.addEventListener('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    fetch(`/prodregistromalestado/${this.dataset.id}/update-descripcion`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        },
                        body: JSON.stringify({
                            descripcion_problema: this.value
                        })
                    });
                }, 500); // Espera 500ms después de que el usuario deje de escribir
            });
        });

        // Cambiar estado en tiempo real
        document.querySelectorAll('.estado-select').forEach(select => {
            select.addEventListener('change', function() {
                fetch(`/prodregistromalestado/${this.dataset.id}/update-estado`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    body: JSON.stringify({
                        estado: this.value
                    })
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/registros/index.blade.php ENDPATH**/ ?>