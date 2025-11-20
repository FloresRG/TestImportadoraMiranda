// Payment method display logic
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mostrar campos correctamente según el tipo de pago seleccionado
    document.querySelectorAll('input[name="tipo_pago"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            var montoPagadoLabel = document.getElementById('monto-pagado-label');
            var pagosEfctivoQr = document.getElementById('pagos-efectivo-qr');
            // Restablecer la visibilidad de los campos antes de cambiar el comportamiento
            pagosEfctivoQr.style.display = 'none';
            montoPagadoLabel.textContent = 'Monto Pagado';
            // Mostrar los campos adicionales según el tipo de pago seleccionado
            if (this.value === "Efectivo") {
                montoPagadoLabel.textContent = 'Monto Pagado Efectivo';
            } else if (this.value === "QR") {
                montoPagadoLabel.textContent = 'Monto Pagado por QR';
            } else if (this.value === "Efectivo y QR") {
                montoPagadoLabel.textContent = 'Monto Pagado Efectivo';
                pagosEfctivoQr.style.display = 'block';
            }
        });
    });
});

// Seller selection and warranty toggle logic
document.addEventListener('DOMContentLoaded', function() {
    const vendedorInput = document.getElementById('vendedorSearch');
    const idUserInput = document.getElementById('id_user');
    let selectedVendedor = null;
    const defaultVendedorId = '<?php echo e($defaultVendedorId); ?>';

    function aplicarUsoVendedor() {
        if (document.getElementById('usar_vendedor_no') && document.getElementById('usar_vendedor_no').checked) {
            if (vendedorInput) vendedorInput.disabled = true;
            if (vendedorInput) vendedorInput.required = false;
            if (vendedorInput) vendedorInput.value = '';
            if (idUserInput) idUserInput.value = defaultVendedorId;
        } else {
            if (vendedorInput) vendedorInput.disabled = false;
            if (vendedorInput) vendedorInput.required = true;
            // Si el input coincide con una opción, asignar id, sino limpiar
            const option = Array.from(document.getElementById('sugerencias_vendedores').options).find(o => o.value === vendedorInput.value);
            if (option) idUserInput.value = option.dataset.id;
            else idUserInput.value = '';
        }
    }

    if (document.getElementById('usar_vendedor_no')) document.getElementById('usar_vendedor_no').addEventListener('change', aplicarUsoVendedor);
    if (document.getElementById('usar_vendedor_si')) document.getElementById('usar_vendedor_si').addEventListener('change', aplicarUsoVendedor);

    if (vendedorInput) {
        vendedorInput.addEventListener('input', function() {
            const nombreSeleccionado = vendedorInput.value;
            const optionSeleccionada = Array.from(document.getElementById('sugerencias_vendedores').options).find(option => option.value === nombreSeleccionado);
            if (optionSeleccionada) {
                // Guardar el vendedor seleccionado
                selectedVendedor = {
                    id: optionSeleccionada.dataset.id,
                    nombre: nombreSeleccionado
                };
                // Asignar el ID del vendedor al campo oculto
                idUserInput.value = selectedVendedor.id;
            } else {
                selectedVendedor = null;
                if (document.getElementById('usar_vendedor_si') && document.getElementById('usar_vendedor_si').checked) {
                    idUserInput.value = '';
                } else {
                    idUserInput.value = defaultVendedorId;
                }
            }
        });
    }

    // Aplicar estado inicial
    aplicarUsoVendedor();
});

// Warranty switch logic
document.addEventListener('DOMContentLoaded', function() {
    const switchCheckbox = document.getElementById('garantia_switch');
    const hiddenInput = document.getElementById('garantia_hidden');

    // Función para sincronizar los valores ocultos con el estado del switch
    function syncHiddenInputs() {
        if (switchCheckbox && switchCheckbox.checked) {
            // Si el switch está activado (Con Garantía), el campo oculto se deshabilita
            if (hiddenInput) hiddenInput.disabled = true;
        } else {
            // Si el switch está desactivado (Sin Garantía), el campo oculto se habilita
            if (hiddenInput) hiddenInput.disabled = false;
        }
    }

    // Inicializar el estado
    syncHiddenInputs();

    // Escuchar cambios en el switch
    if (switchCheckbox) switchCheckbox.addEventListener('change', function() {
        syncHiddenInputs();
    });

    const switchCheckboxVendedor = document.getElementById('usar_vendedor_switch');
    const hiddenInputVendedor = document.getElementById('usar_vendedor_hidden');
    const vendedorSearchInput = document.getElementById('vendedorSearch');
    const idUserInput = document.getElementById('id_user');
    const defaultVendedorId = '<?php echo e($defaultVendedorId); ?>'; // Asegúrate de que esta variable esté disponible

    function syncHiddenInputsVendedor() {
        if (switchCheckboxVendedor && switchCheckboxVendedor.checked) {
            // Switch activado (Sí), deshabilita el campo oculto "no", habilita el input de búsqueda
            if (hiddenInputVendedor) hiddenInputVendedor.disabled = true;
            if (vendedorSearchInput) vendedorSearchInput.disabled = false;
            if (vendedorSearchInput) vendedorSearchInput.required = true;
            // Si ya hay un vendedor seleccionado, mantener el ID; sino, limpiar
            // (La lógica de selección de vendedor actualizará id_user)
        } else {
            // Switch desactivado (No), habilita el campo oculto "no", deshabilita el input de búsqueda
            if (hiddenInputVendedor) hiddenInputVendedor.disabled = false;
            if (vendedorSearchInput) vendedorSearchInput.disabled = true;
            if (vendedorSearchInput) vendedorSearchInput.required = false;
            if (vendedorSearchInput) vendedorSearchInput.value = ''; // Limpia el campo
            if (idUserInput) idUserInput.value = defaultVendedorId; // Restaura el ID por defecto
        }
    }

    // Inicializar el estado del switch de vendedor (debe estar apagado por defecto)
    // Aseguramos que el switch esté apagado si el valor oculto es "no"
    if (hiddenInputVendedor && hiddenInputVendedor.value === 'no') {
        if (switchCheckboxVendedor) switchCheckboxVendedor.checked = false; // Asegura que el switch esté visualmente apagado
    } else {
        if (switchCheckboxVendedor) switchCheckboxVendedor.checked = true; // Asegura que el switch esté visualmente encendido si el valor oculto es "si"
    }
    syncHiddenInputsVendedor(); // Aplica el estado inicial

    // Escuchar cambios en el switch del vendedor
    if (switchCheckboxVendedor) switchCheckboxVendedor.addEventListener('change', syncHiddenInputsVendedor);

    // --- Lógica existente para la selección de vendedor ---
    // Mantenemos la lógica que actualiza el id_user basado en la selección del datalist
    if (vendedorSearchInput) {
        vendedorSearchInput.addEventListener('input', function() {
            const nombreSeleccionado = vendedorSearchInput.value;
            const optionSeleccionada = Array.from(document.getElementById('sugerencias_vendedores').options).find(option => option.value === nombreSeleccionado);
            if (optionSeleccionada && switchCheckboxVendedor && switchCheckboxVendedor.checked) { // Solo si el switch está activado
                idUserInput.value = optionSeleccionada.dataset.id;
            } else if (switchCheckboxVendedor && !switchCheckboxVendedor.checked) {
                // Si el switch está apagado, restaurar ID por defecto
                idUserInput.value = defaultVendedorId;
            } else {
                // Si el switch está encendido pero no hay opción válida seleccionada
                idUserInput.value = ''; // O puedes dejar el valor anterior si lo prefieres
            }
        });

        // También es bueno escuchar el evento 'blur' para asegurar que si se borra el texto
        // y no hay opción válida, el id_user se limpie (si el switch está encendido)
        vendedorSearchInput.addEventListener('blur', function() {
            if (switchCheckboxVendedor && switchCheckboxVendedor.checked) {
                const nombreSeleccionado = vendedorSearchInput.value;
                const optionSeleccionada = Array.from(document.getElementById('sugerencias_vendedores').options).find(option => option.value === nombreSeleccionado);
                if (!optionSeleccionada) {
                    idUserInput.value = ''; // Limpiar si no coincide con ninguna opción
                }
            }
        });
    }
});

// Main cart and product functionality
$(document).ready(function() {
    // Función para cargar productos con AJAX y paginación
    function fetchProductos(page = 1, search = '') {
        $.ajax({
            url: '<?php echo e(route('control.productos', ['id' => $id])); ?>',
            method: 'GET',
            data: {
                page: page,
                search: search,
            },
            success: function(response) {
                // Cargar productos en el contenedor #product-list
                var html = '';
                response.productos.data.forEach(function(producto) {
                    html += `
                    <div class="col-md-4 ${producto.producto.stock_sucursal <= 0 ? 'out-of-stock-card' : ''}">
                        <div class="card card-widget widget-user shadow-lg">
                                            ${producto.producto.fotos && producto.producto.fotos.length > 0 ?
                                                `<div class="widget-user-header text-white" style="background: url('<?php echo e(asset('storage/')); ?>/${producto.producto.fotos[0].foto}') center center; background-size: cover;">
                                                                                                                                                                                                                                                                                                                     <h3 class="widget-user-username nombre-producto" style="text-shadow: 2px 2px 4px rgba(7, 7, 7, 0.5); font-size: 1.5em; font-weight: bold;">${producto.producto.nombre}</h3>
                                                                                                                                                                                                                                                                                                                 </div>
                                                                                                                                                                                                                                                                                                                 <div class="widget-user-image">
                                                                                                                                                                                                                                                                                                                     <img class="img-circle" src="<?php echo e(asset('storage/')); ?>/${producto.producto.fotos[0].foto}" alt="Producto" loading="lazy" style="width: 128px; height: 128px; object-fit: cover;">
                                                                                                                                                                                                                                                                                                                 </div>` :
                                                `<div class="widget-user-header text-white" style="background-color: #ccc;">
                                                                                                                                                                                                                                                                                                                     <h3 class="widget-user-username nombre-producto" style="text-shadow: 2px 2px 4px rgba(7, 7, 7, 0.5); font-size: 1.5em; font-weight: bold;">${producto.producto.nombre}</h3>
                                                                                                                                                                                                                                                                                                                 </div>
                                                                                                                                                                                                                                                                                                                 <div class="widget-user-image">
                                                                                                                                                                                                                                                                                                                     <img class="img-circle" src="<?php echo e(asset('path/to/default/image.jpg')); ?>" alt="Producto" loading="lazy" style="width: 128px; height: 128px; object-fit: cover;">
                                                                                                                                                                                                                                                                                                                 </div>`
                                            }
                                    <br>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">${producto.producto.precio}</h5>
                                                    <span class="description-text">PRECIO</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">${producto.producto.categoria ? producto.producto.categoria.categoria : 'No categoría'}</h5>
                                                    <span class="description-text">CATEGORÍA</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="description-block">
                                                    <h5 class="description-header">${producto.producto.marca ? producto.producto.marca.marca : 'No marca'}</h5>
                                                    <span class="description-text">MARCA</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="description-block">
                                                    <h5 class="description-header">${producto.producto.stock_actual}</h5>
                                                    <span class="description-text">TOTAL EN ALMACÉN</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="description-block">
                                                    <h5 class="description-header">${producto.producto.stock_sucursal}</h5>
                                                    <span class="description-text">TOTAL EN SUCURSAL</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-block agregar-carrito ${producto.producto.stock_sucursal <= 0 ? 'out-of-stock' : 'btn-success'}" data-id="${producto.producto.id}" data-nombre="${producto.producto.nombre}" data-precio="${producto.producto.precio}" data-stock-sucursal="${producto.producto.stock_sucursal}" data-toggle="modal" data-target="#cantidadModal">
                                        ${producto.producto.stock_sucursal <= 0 ? 'PRODUCTO NO DISPONIBLE, AGREGUE CANTIDAD DEL PRODUCTO' : 'Vender'}
                                    </a>
                                </div>
                            </div>
                        `;
                });
                // Actualizar el listado de productos
                $('#product-list').html(html);
                // Actualizar los enlaces de paginación
                var paginationLinks = '';
                for (var i = 1; i <= response.productos.last_page; i++) {
                    paginationLinks += `
                        <li class="page-item ${i === response.productos.current_page ? 'active' : ''}">
                            <a href="#" class="page-link" data-page="${i}">${i}</a>
                        </li>
                    `;
                }
                $('#pagination').html(paginationLinks);
            }
        });
    }

    // Cargar los productos al cargar la página
    fetchProductos();

    // Búsqueda de productos
    $('#search').on('keyup', function() {
        var search = $(this).val();
        fetchProductos(1, search);
    });

    // Paginación con AJAX
    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        var search = $('#search').val();
        fetchProductos(page, search);
    });

    // Bind eventos de clic a los botones agregar-carrito
    $(document).on('click', '.agregar-carrito', function(e) {
        e.preventDefault();
        productoSeleccionado = {
            id: $(this).data('id'),
            nombre: $(this).data('nombre'),
            precio: parseFloat($(this).data('precio')),
            stockSucursal: parseInt($(this).data('stock-sucursal'))
        };
        // Verificar si el producto ya está en el carrito
        const productoExistente = carrito.find(item => item.id === productoSeleccionado.id);
        if (productoExistente) {
            Swal.fire({
                title: 'Alerta',
                text: 'Ya tienes este producto en el carrito. Dirigiéndote al carrito...',
                icon: 'info',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                mostrarCarrito();
            });
            return;
        }
        // Limpiar el input de cantidad antes de abrir el modal
        document.getElementById('cantidad-input').value = '';
        // Abrir el modal de cantidad
        $('#cantidadModal').modal('show');
    });
});

// Cart variables and functions
let carrito = [];
let carritoContador = document.getElementById('carrito-contador');
let listaCarrito = document.querySelector('#lista-carrito tbody');
let productoSeleccionado = null;

document.getElementById('confirmar-cantidad').addEventListener('click', function() {
    const cantidad = parseInt(document.getElementById('cantidad-input').value);
    if (cantidad > 0) {
        if (cantidad > productoSeleccionado.stockSucursal) {
            Swal.fire({
                title: 'Error',
                html: `
                <p style="font-size: 18px; font-weight: bold;">La cantidad ingresada (${cantidad}) excede el stock en la sucursal que es (${productoSeleccionado.stockSucursal}).</p>
                <p style="color: red; font-size: 26px;">Agregue cantidad del Producto a la Sucursal.</p>
            `,
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
            return;
        }
        const productoExistente = carrito.find(item => item.id === productoSeleccionado.id);
        if (productoExistente) {
            productoExistente.cantidad += cantidad;
        } else {
            carrito.push({
                id: productoSeleccionado.id,
                nombre: productoSeleccionado.nombre,
                precio: productoSeleccionado.precio,
                cantidad: cantidad,
                stockSucursal: productoSeleccionado.stockSucursal // Guardar el stock en la sucursal para futuras validaciones
            });
        }
        Swal.fire({
            title: 'Éxito',
            text: `${productoSeleccionado.nombre} agregado al carrito`,
            icon: 'success',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            // Abre el modal del carrito después de que el usuario acepte el mensaje
            mostrarCarrito();
        });
        actualizarCarritoContador();
        $('#cantidadModal').modal('hide');
    } else {
        Swal.fire({
            title: 'Error',
            text: 'Cantidad inválida',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    }
});

function actualizarCarritoContador() {
    if (carritoContador) carritoContador.innerText = carrito.length;
}

document.getElementById('mostrar-carrito').addEventListener('click', function(e) {
    e.preventDefault();
    mostrarCarrito();
});

// Evento para calcular el total a pagar con descuento
document.getElementById('descuento').addEventListener('input', function() {
    const descuento = parseFloat(this.value) || 0;
    const totalSinDescuento = parseFloat(document.getElementById('total-a-pagar').value) || 0;
    // Restar el descuento solo si se ingresa un valor
    const totalAPagar = totalSinDescuento + descuento;
    document.getElementById('monto-total').value = totalAPagar.toFixed(2);
    // Calcular cambio si hay un monto pagado
    calcularCambio();
});

// Evento para calcular el cambio basado en el monto pagado
document.getElementById('pagado').addEventListener('input', function() {
    calcularCambio();
});

// Evento para actualizar el total a pagar cuando se modifica el total sin descuento
document.getElementById('monto-total').addEventListener('input', function() {
    const totalSinDescuento = parseFloat(this.value) || 0;
    const descuento = parseFloat(document.getElementById('descuento').value) || 0;
    const totalAPagar = totalSinDescuento + descuento;
    document.getElementById('total-a-pagar').value = totalAPagar.toFixed(2);
    // Calcular cambio si hay un monto pagado
    calcularCambio();
});

// Evento para actualizar el total a pagar cuando se modifica el descuento
document.getElementById('total-a-pagar').addEventListener('input', function() {
    const totalAPagar = parseFloat(this.value) || 0;
    const pagado = parseFloat(document.getElementById('pagado').value) || 0;
    const cambio = pagado - totalAPagar;
    document.getElementById('cambio').value = cambio >= 0 ? cambio.toFixed(2) : '0.00';
});

// Función para calcular el cambio
function calcularCambio() {
    const pagado = parseFloat(document.getElementById('pagado').value) || 0;
    const totalAPagar = parseFloat(document.getElementById('total-a-pagar').value) || 0;
    const cambio = pagado - totalAPagar;
    document.getElementById('cambio').value = cambio >= 0 ? cambio.toFixed(2) : '0.00';
}

// Al iniciar, carga el carrito desde localStorage basado en el ID de la sucursal
document.addEventListener('DOMContentLoaded', function() {
    const sucursalId = <?php echo e($id); ?>; // Asegúrate de que este valor sea el ID de la sucursal actual
    const storedCarrito = localStorage.getItem(`carrito-${sucursalId}`);
    if (storedCarrito) {
        carrito = JSON.parse(storedCarrito);
        actualizarCarritoContador();
        mostrarCarrito();
    }
});

// Función para mostrar el carrito
function mostrarCarrito() {
    if (!listaCarrito) return;
    listaCarrito.innerHTML = '';
    if (carrito.length === 0) {
        listaCarrito.innerHTML = '<tr><td colspan="6" class="text-center">El carrito está vacío</td></tr>';
        document.getElementById('monto-total').value = '0.00';
        document.getElementById('total-a-pagar').value = '0.00'; // Resetear total a pagar
        return;
    }
    let totalAPagar = 0;
    carrito.forEach((item, index) => {
        const total = item.precio * item.cantidad;
        totalAPagar += total;
        // Agregar fila editable para precio, cantidad y total
        listaCarrito.innerHTML += `
        <tr>
            <td>${item.id}</td>
            <td>${item.nombre}</td>
            <td><input type="number" class="form-control precio-input" value="${item.precio.toFixed(2)}" data-index="${index}" step="0.01"></td>
            <td><input type="number" class="form-control cantidad-input" value="${item.cantidad}" max="${item.stockSucursal}" data-index="${index}" step="1"></td>
            <td><input type="number" class="form-control total-input" value="${total.toFixed(2)}" data-index="${index}" step="0.01" ></td>
            <td><button class="btn btn-danger btn-sm eliminar" data-id="${item.id}">Eliminar</button></td>
        </tr>
        `;
    });
    // Actualizar el total a pagar
    document.getElementById('monto-total').value = totalAPagar.toFixed(2);
    document.getElementById('cambio').value = ''; // Limpiar cambio
    document.getElementById('total-a-pagar').value = totalAPagar.toFixed(2); // Total a pagar sin descuento
    // Agregar eventos para actualizar datos al modificar precio, cantidad o total
    // Agregar eventos para actualizar datos al modificar precio, cantidad o total
    // Actualizar los totales generales cuando el campo pierda el foco (evento blur)
    document.querySelectorAll('.precio-input, .cantidad-input, .total-input').forEach(input => {
        input.addEventListener('blur', function() {
            const index = this.getAttribute('data-index');
            let nuevoPrecio, nuevaCantidad, nuevoTotal;
            // Validar y limpiar el valor de entrada
            const valor = this.value.trim();
            if (this.classList.contains('precio-input')) {
                nuevoPrecio = parseFloat(this.value); // Cambiar a parseFloat
                carrito[index].precio = nuevoPrecio;
                nuevaCantidad = carrito[index].cantidad;
                nuevoTotal = nuevoPrecio * nuevaCantidad;
            } else if (this.classList.contains('cantidad-input')) {
                nuevaCantidad = parseFloat(this.value); // Cambiar a parseFloat para permitir decimales en la cantidad
                if (nuevaCantidad > 0) {
                    carrito[index].cantidad = nuevaCantidad;
                    nuevoPrecio = carrito[index].precio;
                    nuevoTotal = nuevoPrecio * nuevaCantidad;
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'La cantidad debe ser mayor que cero.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                    this.value = carrito[index].cantidad;
                    return;
                }
            } else if (this.classList.contains('total-input')) {
                nuevoTotal = parseFloat(this.value); // Cambiar a parseFloat para aceptar decimales en total
                nuevaCantidad = carrito[index].cantidad;
                if (nuevaCantidad > 0) {
                    nuevoPrecio = nuevoTotal / nuevaCantidad;
                    carrito[index].precio = nuevoPrecio;
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'La cantidad debe ser mayor que cero para calcular el precio.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                    this.value = (carrito[index].precio * nuevaCantidad).toFixed(2);
                    return;
                }
            }
            // Actualizar los campos relacionados
            const fila = listaCarrito.querySelectorAll('tr')[index];
            fila.querySelector('.precio-input').value = carrito[index].precio.toFixed(2);
            fila.querySelector('.cantidad-input').value = carrito[index].cantidad.toFixed(2);
            fila.querySelector('.total-input').value = nuevoTotal.toFixed(2);
            // Actualizar los totales generales
            actualizarTotales();
        });
        // Evitar que se elimine el producto cuando se presiona Enter en los campos editables
        input.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Evita la acción por defecto de la tecla Enter (que podría hacer que el producto se elimine)
            }
        });
    });
    $('#carritoModal').modal('show');
    // Almacenar el carrito en localStorage con el ID de la sucursal
    const sucursalId = <?php echo e($id); ?>;
    localStorage.setItem(`carrito-${sucursalId}`, JSON.stringify(carrito));
}

// Función para actualizar los totales generales
function actualizarTotales() {
    let totalAPagar = 0;
    carrito.forEach(item => {
        totalAPagar += item.precio * item.cantidad;
    });
    document.getElementById('monto-total').value = totalAPagar.toFixed(2);
    document.getElementById('total-a-pagar').value = totalAPagar.toFixed(2); // Total a pagar sin descuento
    // Calcular cambio si hay un monto pagado
    calcularCambio();
    // Almacenar el carrito en localStorage con el ID de la sucursal
    const sucursalId = <?php echo e($id); ?>; // Este es un valor dinámico, asegúrate de que esté definido en el backend
    localStorage.setItem(`carrito-${sucursalId}`, JSON.stringify(carrito));
}

document.getElementById('vaciar-carrito-fvc').addEventListener('click', function(e) {
    e.preventDefault();
    carrito = [];
    actualizarCarritoContador();
    mostrarCarrito();
    // Limpiar el carrito en localStorage
    const sucursalId = <?php echo e($id); ?>;
    localStorage.removeItem(`carrito-${sucursalId}`);
});

listaCarrito.addEventListener('click', function(e) {
    if (e.target.classList.contains('eliminar')) {
        const id = parseInt(e.target.getAttribute('data-id')); // Convertir a número
        carrito = carrito.filter(item => item.id !== id); // Filtrar productos que no coincidan con el id
        actualizarCarritoContador();
        mostrarCarrito();
        // Actualizar el carrito en localStorage
        const sucursalId = <?php echo e($id); ?>; // Este es un valor dinámico, asegúrate de que esté definido en el backend
        localStorage.setItem(`carrito-${sucursalId}`, JSON.stringify(carrito));
    }
});

document.getElementById('venta-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar el envío predeterminado del formulario
    // Obtener el id de sucursal (por ejemplo, desde un valor en el backend o en un campo oculto)
    const sucursalId = <?php echo e($id); ?>; // Asumimos que $id es el ID de la sucursal disponible desde el backend
    // Verificar si la caja está abierta para esa sucursal
    fetch(`/verificar-caja-abierta/${sucursalId}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                Swal.fire({
                    title: 'Error',
                    text: data.error,
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
                return; // No enviar el formulario si la caja no está abierta
            }
            // La caja está abierta, continuar con la lógica de venta
            const user = document.getElementById('id_user').value;
            // Validaciones
            const clienteNombre = document.getElementById('cliente').value.trim();
            const costoTotal = parseFloat(document.getElementById('total-a-pagar').value);
            const ci = document.getElementById('ci').value; // Obtiene el valor como una cadena
            if (!clienteNombre) {
                Swal.fire({
                    title: 'Error',
                    text: 'El nombre del cliente es obligatorio.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }
            if (isNaN(costoTotal) || costoTotal <= 0) {
                Swal.fire({
                    title: 'Error',
                    text: 'El monto total debe ser mayor que cero.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }
            // Recoger productos del carrito con precios y cantidades editados
            const productos = [];
            const rows = document.querySelectorAll('#lista-carrito tbody tr');
            rows.forEach(row => {
                const id = row.querySelector('td:nth-child(1)').innerText; // ID del producto
                const nombre = row.querySelector('td:nth-child(2)').innerText; // Nombre del producto
                const precio = parseFloat(row.querySelector('td:nth-child(3) input').value); // Precio editable
                const cantidad = parseInt(row.querySelector('td:nth-child(4) input').value); // Cantidad editable
                const total = parseFloat(row.querySelector('td:nth-child(5) input').value); // Total editable
                productos.push({
                    id: id,
                    nombre: nombre,
                    precio: precio,
                    cantidad: cantidad,
                    total: total
                });
            });
            // Get the selected payment method
            const tipoPagoInput = document.querySelector('input[name="tipo_pago"]:checked');
            const tipoPago = tipoPagoInput ? tipoPagoInput.value : null;
            // Crear campos ocultos para el formulario
            const inputProductos = document.createElement('input');
            inputProductos.type = 'hidden';
            inputProductos.name = 'productos';
            inputProductos.value = JSON.stringify(productos);
            this.appendChild(inputProductos);
            const inputCliente = document.createElement('input');
            inputCliente.type = 'hidden';
            inputCliente.name = 'nombre_cliente';
            inputCliente.value = clienteNombre;
            this.appendChild(inputCliente);
            const inputCostoTotal = document.createElement('input');
            inputCostoTotal.type = 'hidden';
            inputCostoTotal.name = 'costo_total';
            inputCostoTotal.value = costoTotal.toFixed(2);
            this.appendChild(inputCostoTotal);
            // Agregar el campo CI
            const inputCI = document.createElement('input');
            inputCI.type = 'hidden';
            inputCI.name = 'ci'; // Asegúrate de que el nombre sea correcto
            inputCI.value = ci;
            this.appendChild(inputCI);
            // Agregar el campo descuento
            const descuentoInput = document.getElementById('descuento');
            const inputDescuento = document.createElement('input');
            inputDescuento.type = 'hidden';
            inputDescuento.name = 'descuento';
            inputDescuento.value = descuentoInput.value || '0'; // Usa 0 si no hay valor
            this.appendChild(inputDescuento);
            // Agregar monto pagado
            const pagadoInput = document.getElementById('pagado');
            const inputPagado = document.createElement('input');
            inputPagado.type = 'hidden';
            inputPagado.name = 'pagado';
            inputPagado.value = pagadoInput.value || '0'; // Usa 0 si no hay valor
            this.appendChild(inputPagado);
            // Agregar monto pagado (QR)
            const pagadoqrInput = document.getElementById('pagado_qr');
            const inputPagadoqr = document.createElement('input');
            inputPagadoqr.type = 'hidden';
            inputPagadoqr.name = 'pagado_qr';
            inputPagadoqr.value = pagadoqrInput.value || '0'; // Usa 0 si no hay valor
            this.appendChild(inputPagadoqr);
            // Agregar el cambio (si es necesario)
            const cambioInput = document.getElementById('cambio');
            const inputCambio = document.createElement('input');
            inputCambio.type = 'hidden';
            inputCambio.name = 'cambio';
            inputCambio.value = cambioInput.value || '0'; // Usa 0 si no hay valor
            this.appendChild(inputCambio);
            // Agregar el tipo de pago
            const inputTipoPago = document.createElement('input');
            inputTipoPago.type = 'hidden';
            inputTipoPago.name = 'tipo_pago';
            inputTipoPago.value = tipoPago;
            this.appendChild(inputTipoPago);
            // **Aquí es donde agregas el id_sucursal como un campo oculto**
            const inputSucursal = document.createElement('input');
            inputSucursal.type = 'hidden';
            inputSucursal.name = 'id_sucursal';
            inputSucursal.value = sucursalId; // Aquí ya tomas el id de sucursal
            this.appendChild(inputSucursal);
            // Enviar el formulario usando fetch
            fetch(this.action, {
                    method: 'POST',
                    body: new FormData(this),
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Obtener el valor del radio seleccionado
                        let garantia = document.querySelector('input[name="garantia"]:checked');
                        let tipoGarantia = garantia ? garantia.value : 'sin_garantia'; // Si no hay selección, por defecto 'sin_garantia'
                        // Redirigir para descargar el PDF
                        const url = '<?php echo e(route('nota.pdf')); ?>?nombre_cliente=' + encodeURIComponent(clienteNombre) + '&costo_total=' + encodeURIComponent(costoTotal.toFixed(2)) + '&ci=' + encodeURIComponent(inputCI.value) + '&id_user=' + encodeURIComponent(user) + '&productos=' + encodeURIComponent(JSON.stringify(productos)) + '&descuento=' + encodeURIComponent(descuentoInput.value || '0') + '&pagado=' + encodeURIComponent(pagadoInput.value || '0') + '&pagadoqr=' + encodeURIComponent(pagadoqrInput.value || '0') + '&cambio=' + encodeURIComponent(cambioInput.value || '0') + '&tipo_pago=' + encodeURIComponent(tipoPago) + '&garantia=' + encodeURIComponent(tipoGarantia) + // Agregar garantía
                            '&id_sucursal=' + encodeURIComponent(sucursalId); // Aquí agregamos el id_sucursal
                        // Abrir la URL en una nueva pestaña
                        window.open(url, '_blank');
                        // Limpiar el carrito y los campos del formulario
                        carrito = [];
                        localStorage.removeItem(`carrito-${sucursalId}`);
                        document.getElementById('monto-total').value = '0.00';
                        document.getElementById('total-a-pagar').value = '0.00';
                        document.getElementById('cambio').value = '0.00';
                        document.getElementById('cliente').value = '';
                        document.getElementById('ci').value = '';
                        document.getElementById('descuento').value = '0';
                        document.getElementById('pagado').value = '';
                        document.getElementById('pagado_qr').value = '';
                        listaCarrito.innerHTML = '<tr><td colspan="6" class="text-center">El carrito está vacío</td></tr>';
                        carritoContador.innerText = '0';
                        window.location.reload();
                    } else {
                        // Manejar error
                        Swal.fire({
                            title: 'Error',
                            text: data.message || 'Ocurrió un error en la venta',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Ocurrió un error al procesar la venta',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                    window.location.reload();
                });
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error',
                text: 'Hubo un problema Con la Conexion a Internet, Verifica tu conexion',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        });
});

// Modal navigation scripts
document.getElementById('ver-qr').addEventListener('click', function() {
    $('#carritoModal').modal('hide');
    $('#qrModal').modal('show');
    // Mantener el foco dentro del modal del QR
    $('#qrModal').on('shown.bs.modal', function() {
        $(this).find('.modal-body').focus();
    });
});

document.getElementById('cerrar-qr-modal').addEventListener('click', function() {
    $('#qrModal').modal('hide');
    $('#carritoModal').modal('show');
    // Mantener el foco dentro del modal del carrito
    $('#carritoModal').on('shown.bs.modal', function() {
        $(this).find('.modal-body').focus();
    });
});

document.getElementById('regresar-carrito').addEventListener('click', function() {
    $('#qrModal').modal('hide');
    $('#carritoModal').modal('show');
    // Mantener el foco dentro del modal del carrito
    $('#carritoModal').on('shown.bs.modal', function() {
        $(this).find('.modal-body').focus();
    });
});

// Clock update function
document.addEventListener('DOMContentLoaded', function() {
    // Function to update the clock
    function updateClock() {
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        document.getElementById('clock').innerText = `${hours}:${minutes}:${seconds}`;
    }
    // Update the clock every second
    updateClock();
    setInterval(updateClock, 1000);
});
</script><?php /**PATH D:\Trabajo Nexus\TestImportadoraMiranda\resources\views/js/pro.blade.php ENDPATH**/ ?>