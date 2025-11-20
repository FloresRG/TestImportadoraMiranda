<script>
// Alpine.js store for cart management (like productos.blade.php)
document.addEventListener("alpine:init", () => {
    Alpine.store("carrito", {
        items: (() => {
            try {
                const sucursalId = {{ $id }};
                const data = localStorage.getItem(`carrito-${sucursalId}`);
                return data ? JSON.parse(data) : [];
            } catch (e) {
                return [];
            }
        })(),

        guardar() {
            const sucursalId = {{ $id }};
            localStorage.setItem(`carrito-${sucursalId}`, JSON.stringify(this.items));
        },

        get totalItems() {
            return this.items.reduce((sum, item) => sum + item.cantidad, 0);
        },

        agregar(producto) {
            if (producto.stock <= 0) return;

            const item = this.items.find((i) => i.id === producto.id);
            if (item) {
                item.cantidad++;
            } else {
                this.items.push({
                    id: producto.id,
                    nombre: producto.nombre,
                    precio: producto.precio,
                    cantidad: 1,
                });
            }
            this.guardar();

            // 🔊 Sonido
            const audio = new Audio("/sounds/timbre.mp3");
            audio.play().catch((e) => console.warn("Audio play failed:", e));

            // 🍞 Notificación tipo toast
            Swal.fire({
                title: "Producto agregado",
                text: `${producto.nombre} agregado al carrito`,
                icon: "success",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
            });
        },

        quitar(id) {
            this.items = this.items.filter((i) => i.id !== id);
            this.guardar();
        },
    });

    Alpine.data("productosApp", (sucursalId) => ({
        query: "",
        sugerencias: [],
        inputFocused: false,
        debounceTimer: null,

        init() {
            this.loadProductos();
            this.$watch("query", () => {
                if (this.query.length < 2) this.sugerencias = [];
                clearTimeout(this.debounceTimer);
                this.debounceTimer = setTimeout(() => {
                    this.loadProductos(1);
                    if (this.query.length >= 2) this.buscarSugerencias();
                }, 350);
            });

            this.$el.addEventListener("agregar-al-carrito", (e) => {
                Alpine.store("carrito").agregar(e.detail);
            });
        },

        async loadProductos(page = 1) {
            const url = new URL(
                `/control/sucursal/${sucursalId}`,
                window.location.origin
            );
            if (this.query.length >= 2)
                url.searchParams.set("search", this.query);
            url.searchParams.set("page", page);

            try {
                const response = await axios.get(url.toString(), {
                    headers: { "X-Requested-With": "XMLHttpRequest" },
                });

                // The controller returns JSON with 'productos' key
                const productos = response.data.productos;
                if (productos && productos.data) {
                    // Render products using the partial template
                    const html = await this.renderProductos(productos.data);
                    document.getElementById("productos-list").innerHTML = html;

                    // Render pagination
                    const paginationHtml = this.renderPagination(productos);
                    document.getElementById("pagination-links").innerHTML = paginationHtml;
                }
            } catch (err) {
                console.error("Error al cargar productos:", err);
                document.getElementById("productos-list").innerHTML = '<div class="col-12"><div class="text-center py-5"><div class="bg-light rounded-3 d-inline-flex p-4 mb-3"><i class="fas fa-exclamation-triangle fa-2x text-warning"></i></div><p class="text-muted mb-0" style="font-size: 1.25rem;">Error al cargar productos</p></div></div>';
            }
        },

        async renderProductos(productos) {
            // Render each product using the same structure as the partial
            let html = '';
            productos.forEach(producto => {
                const stockSucursal = producto.cantidad || 0;
                const precio = producto.producto?.precio || 0;
                const nombre = producto.producto?.nombre || 'Producto sin nombre';
                const categoria = producto.producto?.categoria?.categoria || '—';
                const marca = producto.producto?.marca?.marca || '—';
                const stockActual = producto.producto?.stock_actual || 0;
                const fotos = producto.producto?.fotos || [];

                html += `
                    <div class="col-md-4 mb-4">
                        <div class="position-relative rounded-4 overflow-hidden shadow-sm border" style="width: 100%; height: 470px; background: white;">
                            ${fotos.length > 0 ? `<div class="w-100 h-100 position-absolute top-0 start-0 opacity-15" style="background-image: url('/storage/${fotos[0].foto}'); background-size: cover; background-position: center; z-index: 0;"></div>` : ''}
                            <div class="position-absolute top-0 start-0 w-100 py-2 text-center" style="background: linear-gradient(135deg, #ffffff 0%, #cc9efd 25%, #a582ff 50%, #3b78d8 75%, #3b78d8 100%); z-index: 2;">
                                <h5 class="text-white fw-bold mb-0" style="font-size: 1.6rem; text-shadow: 0 1px 3px rgba(0,0,0,0.5);">${nombre}</h5>
                            </div>
                            <div class="position-relative z-1 d-flex flex-column justify-content-between h-100 pt-16 px-4 pb-4">
                                <div class="d-flex justify-content-end">
                                    <div class="d-flex flex-column align-items-end gap-3">
                                        <span class="badge rounded-pill px-4 py-2" style="background-color: #dbeafe; color: #1d4ed8; font-weight: 700; font-size: 1.1rem;">${stockSucursal} en stock</span>
                                        <span class="badge rounded-pill px-4 py-2" style="background-color: #e0f2fe; color: #0ea5e9; font-weight: 700; font-size: 1.1rem;">${categoria}</span>
                                        <span class="badge rounded-pill px-4 py-2" style="background-color: #cffafe; color: #0891b2; font-weight: 700; font-size: 1.1rem;">${marca}</span>
                                        <span class="badge rounded-pill px-4 py-2" style="background-color: #bae6fd; color: #0284c7; font-weight: 700; font-size: 1.1rem;">${stockActual}</span>
                                    </div>
                                </div>
                                <div class="mt-auto">
                                    <p class="badge rounded-pill px-4 py-2 mb-3" style="background-color: #bae6fd; color: #0284c7; font-weight: 700; font-size: 1.25rem; width: fit-content;">Bs. ${parseFloat(precio).toFixed(2).replace('.', ',')}</p>
                                    <button type="button" x-data @click="$dispatch('agregar-al-carrito', { id: ${producto.producto?.id || producto.id}, nombre: '${nombre.replace(/'/g, "\\'")}', precio: ${precio}, stock: ${stockSucursal} })" class="btn fw-bold text-white rounded-pill w-100 py-3 position-relative overflow-hidden" style="background: linear-gradient(135deg, #ffffff 0%, #cc9efd 25%, #a582ff 50%, #3b78d8 75%, #3b78d8 100%); border: none; font-size: 1.3rem; font-weight: 800; letter-spacing: 0.5px; transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='scale(1.03)'; this.style.boxShadow='0 6px 16px rgba(59, 120, 216, 0.4)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';" ${stockSucursal <= 0 ? 'disabled' : ''}>
                                        ${stockSucursal > 0 ? 'VENDER' : 'SIN STOCK'}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });

            if (productos.length === 0) {
                html = '<div class="col-12"><div class="text-center py-5"><div class="bg-light rounded-3 d-inline-flex p-4 mb-3"><i class="fas fa-inbox fa-2x text-muted"></i></div><p class="text-muted mb-0" style="font-size: 1.25rem;">No hay productos en esta sucursal.</p></div></div>';
            }

            return html;
        },

        renderPagination(productos) {
            if (!productos.last_page || productos.last_page <= 1) return '';

            let paginationHtml = '<ul class="pagination justify-content-center">';
            for (let i = 1; i <= productos.last_page; i++) {
                paginationHtml += `<li class="page-item ${i === productos.current_page ? 'active' : ''}"><a href="#" class="page-link" data-page="${i}">${i}</a></li>`;
            }
            paginationHtml += '</ul>';
            return paginationHtml;
        },

        async buscarSugerencias() {
            try {
                const res = await axios.get(
                    `/ventas/sugerencias/${sucursalId}`,
                    { params: { q: this.query } }
                );
                this.sugerencias = res.data;
            } catch (err) {
                console.error("Error en sugerencias:", err);
            }
        },

        selectSuggestion(item) {
            this.query = item.nombre;
            this.sugerencias = [];
            this.inputFocused = false;
        },
    }));
});

// Payment method display logic
document.addEventListener('DOMContentLoaded', function() {
    // Mostrar campos correctamente según el tipo de pago seleccionado
    document.querySelectorAll('input[name="tipo_pago"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            var montoPagadoLabel = document.getElementById('monto-pagado-label');
            var pagosEfctivoQr = document.getElementById('pagos-efectivo-qr');
            // Restablecer la visibilidad de los campos antes de cambiar el comportamiento
            if (pagosEfctivoQr) pagosEfctivoQr.style.display = 'none';
            if (montoPagadoLabel) montoPagadoLabel.textContent = 'Monto Pagado';
            // Mostrar los campos adicionales según el tipo de pago seleccionado
            if (this.value === "Efectivo") {
                if (montoPagadoLabel) montoPagadoLabel.textContent = 'Monto Pagado Efectivo';
            } else if (this.value === "QR") {
                if (montoPagadoLabel) montoPagadoLabel.textContent = 'Monto Pagado por QR';
            } else if (this.value === "Efectivo y QR") {
                if (montoPagadoLabel) montoPagadoLabel.textContent = 'Monto Pagado Efectivo';
                if (pagosEfctivoQr) pagosEfctivoQr.style.display = 'block';
            }
        });
    });
});

// Seller selection and warranty toggle logic
document.addEventListener('DOMContentLoaded', function() {
    const vendedorInput = document.getElementById('vendedorSearch');
    const idUserInput = document.getElementById('id_user');
    let selectedVendedor = null;
    const defaultVendedorId = '{{ $defaultVendedorId }}';

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
    const defaultVendedorId = '{{ $defaultVendedorId }}'; // Asegúrate de que esta variable esté disponible

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

// Cart variables and functions (adapted for Alpine.js store)
let carritoContador = document.getElementById('carrito-contador');
let listaCarrito = document.querySelector('#lista-carrito tbody');

// Función para actualizar el carrito contador usando Alpine store
function actualizarCarritoContador() {
    if (carritoContador) carritoContador.innerText = Alpine.store("carrito").totalItems;
}

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

// Función para mostrar el carrito
function mostrarCarrito() {
    if (!listaCarrito) return;
    listaCarrito.innerHTML = '';
    const carrito = Alpine.store("carrito").items;
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
            <td><input type="number" class="form-control cantidad-input" value="${item.cantidad}" data-index="${index}" step="1"></td>
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
    Alpine.store("carrito").guardar();
}

// Función para actualizar los totales generales
function actualizarTotales() {
    const carrito = Alpine.store("carrito").items;
    let totalAPagar = 0;
    carrito.forEach(item => {
        totalAPagar += item.precio * item.cantidad;
    });
    document.getElementById('monto-total').value = totalAPagar.toFixed(2);
    document.getElementById('total-a-pagar').value = totalAPagar.toFixed(2); // Total a pagar sin descuento
    // Calcular cambio si hay un monto pagado
    calcularCambio();
    // Almacenar el carrito en localStorage con el ID de la sucursal
    Alpine.store("carrito").guardar();
}

document.getElementById('vaciar-carrito-fvc').addEventListener('click', function(e) {
    e.preventDefault();
    Alpine.store("carrito").items = [];
    actualizarCarritoContador();
    mostrarCarrito();
    // Limpiar el carrito en localStorage
    const sucursalId = {{ $id }};
    localStorage.removeItem(`carrito-${sucursalId}`);
});

listaCarrito.addEventListener('click', function(e) {
    if (e.target.classList.contains('eliminar')) {
        const id = parseInt(e.target.getAttribute('data-id')); // Convertir a número
        Alpine.store("carrito").quitar(id); // Usar el método del store
        actualizarCarritoContador();
        mostrarCarrito();
    }
});

document.getElementById('venta-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar el envío predeterminado del formulario
    // Obtener el id de sucursal (por ejemplo, desde un valor en el backend o en un campo oculto)
    const sucursalId = {{ $id }}; // Asumimos que $id es el ID de la sucursal disponible desde el backend
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
            const productos = Alpine.store("carrito").items.map(item => ({
                id: item.id,
                nombre: item.nombre,
                precio: item.precio,
                cantidad: item.cantidad,
                total: item.precio * item.cantidad
            }));
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
                        const url = '{{ route('nota.pdf') }}?nombre_cliente=' + encodeURIComponent(clienteNombre) + '&costo_total=' + encodeURIComponent(costoTotal.toFixed(2)) + '&ci=' + encodeURIComponent(inputCI.value) + '&id_user=' + encodeURIComponent(user) + '&productos=' + encodeURIComponent(JSON.stringify(productos)) + '&descuento=' + encodeURIComponent(descuentoInput.value || '0') + '&pagado=' + encodeURIComponent(pagadoInput.value || '0') + '&pagadoqr=' + encodeURIComponent(pagadoqrInput.value || '0') + '&cambio=' + encodeURIComponent(cambioInput.value || '0') + '&tipo_pago=' + encodeURIComponent(tipoPago) + '&garantia=' + encodeURIComponent(tipoGarantia) + // Agregar garantía
                            '&id_sucursal=' + encodeURIComponent(sucursalId); // Aquí agregamos el id_sucursal
                        // Abrir la URL en una nueva pestaña
                        window.open(url, '_blank');
                        // Limpiar el carrito y los campos del formulario
                        Alpine.store("carrito").items = [];
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


// Show cart button
document.getElementById('mostrar-carrito').addEventListener('click', function(e) {
    e.preventDefault();
    mostrarCarrito();
});

// Pagination click handler
document.addEventListener('click', function(e) {
    const pageLink = e.target.closest('.page-link');
    if (pageLink && pageLink.hasAttribute('data-page')) {
        e.preventDefault();
        const page = parseInt(pageLink.getAttribute('data-page'));
        const alpineEl = document.querySelector('[x-data*="productosApp"]');
        if (alpineEl && alpineEl.__x) {
            alpineEl.__x.$data.loadProductos(page);
        }
    }
});

// Clock update function
document.addEventListener('DOMContentLoaded', function() {
    // Function to update the clock
    function updateClock() {
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        const clockElement = document.getElementById('clock');
        if (clockElement) {
            clockElement.innerText = `${hours}:${minutes}:${seconds}`;
        }
    }
    // Update the clock every second
    updateClock();
    setInterval(updateClock, 1000);
});
</script>