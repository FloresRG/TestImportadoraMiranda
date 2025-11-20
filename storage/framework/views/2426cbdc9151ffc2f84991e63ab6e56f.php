

<?php $__env->startSection('content'); ?>
    <h1 class="text-center mb-4">Editar Producto</h1>

    <div class="container">
        <form action="<?php echo e(route('productos.update', $producto)); ?>" method="POST" enctype="multipart/form-data"
            class="bg-light p-4 rounded shadow-sm mx-auto" style="max-width: 800px;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" value="<?php echo e($producto->nombre); ?>" class="form-control" required>
                </div>

                <div class="col-md-6 form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="4" required><?php echo e($producto->descripcion); ?></textarea>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="precio">Precio</label>
                    <input type="number" step="0.01" name="precio" value="<?php echo e($producto->precio); ?>" class="form-control"
                        required>
                </div>
                <div class="col-md-6 form-group">
                    <label for="precio_descuento">Stock Inicial</label>
                    <input type="number" step="0.01" name="precio_descuento" value="<?php echo e($producto->precio_descuento); ?>"
                        class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" value="<?php echo e($producto->stock); ?>" class="form-control" required>
                </div>
                <div class="col-md-6 form-group">
                    <label for="estado">Estado</label>
                    <div class="d-flex">
                        <div class="form-check me-3">
                            <input type="radio" name="estado" value="1" class="form-check-input" id="estadoActivo"
                                <?php echo e($producto->estado ? 'checked' : ''); ?> required>
                            <label class="form-check-label" for="estadoActivo">DESTACADO</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="estado" value="0" class="form-check-input" id="estadoInactivo"
                                <?php echo e(!$producto->estado ? 'checked' : ''); ?> required>
                            <label class="form-check-label" for="estadoInactivo">NO DESTACADO</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" value="<?php echo e($producto->fecha); ?>" class="form-control" required>
                </div>

                <div class="col-md-6 form-group">
                    <label for="id_cupo">Cupo</label>
                    <select name="id_cupo" class="form-control">
                        <option value="">Seleccione</option>
                        <?php $__currentLoopData = $cupos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cupo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cupo->id); ?>" <?php echo e($producto->id_cupo == $cupo->id ? 'selected' : ''); ?>>
                                <?php echo e($cupo->codigo); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="id_tipo">Tipo</label>
                    <select name="id_tipo" class="form-control" required>
                        <?php $__currentLoopData = $tipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tipo->id); ?>" <?php echo e($producto->id_tipo == $tipo->id ? 'selected' : ''); ?>>
                                <?php echo e($tipo->tipo); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-md-4 form-group">
                    <label for="id_categoria">Categoría</label>
                    <select name="id_categoria" class="form-control" required>
                        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($categoria->id); ?>"
                                <?php echo e($producto->id_categoria == $categoria->id ? 'selected' : ''); ?>>
                                <?php echo e($categoria->categoria); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-md-4 form-group">
                    <label for="id_marca">Marca</label>
                    <select name="id_marca" class="form-control" required>
                        <?php $__currentLoopData = $marcas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($marca->id); ?>" <?php echo e($producto->id_marca == $marca->id ? 'selected' : ''); ?>>
                                <?php echo e($marca->marca); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="fotos">Fotos (Opcional)</label>
                    <input type="file" name="fotos[]" class="form-control" multiple accept="image/*" id="file-input">
                </div>
            </div>

            <!-- Contenedor para las previsualizaciones -->
            <div id="preview" class="mt-3"></div>

            <div class="d-flex justify-content-end mt-3">
                <a href="<?php echo e(route('productos.index')); ?>" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left"></i> Volver Atrás
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-edit"></i> Actualizar Producto
                </button>
            </div>
        </form>

        <h3 class="mt-4 text-center">Fotos actuales</h3>
        <div class="text-center">
            <ul class="list-unstyled d-inline-flex flex-wrap justify-content-center">
                <?php $__currentLoopData = $fotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="m-2">
                        <img src="<?php echo e(asset('storage/' . $foto->foto)); ?>" alt="Foto" style="width: 100px;">
                        <form action="<?php echo e(route('productos.fotos.destroy', $foto)); ?>" method="POST"
                            style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar Foto</button>
                        </form>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>

    <script>
        document.getElementById('file-input').addEventListener('change', function(event) {
            const preview = document.getElementById('preview');
            preview.innerHTML = ''; // Limpiar el contenedor de previsualización

            const files = event.target.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px'; // Ajustar el tamaño según sea necesario
                    img.style.marginRight = '10px';
                    preview.appendChild(img);
                }

                reader.readAsDataURL(file);
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u919984931/domains/importadoramiranda.com/resources/views/productos/edit.blade.php ENDPATH**/ ?>