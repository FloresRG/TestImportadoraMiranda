<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Veripagos - Generar QR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">
    <div class="max-w-lg mx-auto bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Pago con QR - Veripagos</h1>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Monto (Bs.)</label>
            <input
                type="number"
                step="0.01"
                id="monto"
                placeholder="Ej. 15.90"
                class="w-full p-2 border rounded mt-1"
                min="0"
            />
        </div>

        <button
            onclick="generarQr()"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded font-medium"
        >
            Generar QR
        </button>

        <div id="resultado" class="mt-6 hidden">
            <h2 class="text-lg font-semibold mb-2">Escanea este código:</h2>
            <img id="qr-img" class="w-full max-w-xs mx-auto border rounded" />
            <p class="text-sm text-gray-600 mt-2">
                ID: <span id="movimiento-id" class="font-mono"></span>
            </p>
            <button
                onclick="verificarQr()"
                class="mt-3 w-full bg-green-600 hover:bg-green-700 text-white py-1.5 rounded text-sm"
            >
                Verificar Estado del Pago
            </button>
        </div>

        <div id="mensaje" class="mt-4 text-sm min-h-[24px]"></div>
    </div>

    <script>
        let movimientoId = null;

        async function generarQr() {
            const monto = document.getElementById('monto').value;
            if (!monto || parseFloat(monto) <= 0) {
                mostrarMensaje('Ingresa un monto válido.', 'red');
                return;
            }

            try {
                const res = await fetch("{{ route('veripagos.generar') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ monto: parseFloat(monto) })
                });

                const data = await res.json();

                if (data.Codigo === 0 && data.Data) {
                    document.getElementById('qr-img').src = 'data:image/png;base64,' + data.Data.qr;
                    document.getElementById('movimiento-id').textContent = data.Data.movimiento_id;
                    movimientoId = data.Data.movimiento_id;
                    document.getElementById('resultado').classList.remove('hidden');
                    mostrarMensaje('✅ QR generado. ¡Escanea con tu app bancaria!', 'green');
                } else {
                    mostrarMensaje('❌ ' + (data.Mensaje || 'Error al generar QR'), 'red');
                }
            } catch (err) {
                mostrarMensaje('⚠️ Error de conexión', 'orange');
            }
        }

        async function verificarQr() {
            if (!movimientoId) return;

            try {
                const res = await fetch("{{ route('veripagos.verificar') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ movimiento_id: movimientoId })
                });

                const data = await res.json();

                if (data.Codigo === 0 && data.Data) {
                    const estado = data.Data.estado;
                    const color = estado === 'Completado' ? 'green' : 'orange';
                    mostrarMensaje(`📌 Estado: ${estado} | Monto: Bs. ${data.Data.monto}`, color);
                } else {
                    mostrarMensaje('❌ ' + (data.Mensaje || 'No se pudo verificar'), 'red');
                }
            } catch (err) {
                mostrarMensaje('⚠️ Error al verificar', 'orange');
            }
        }

        function mostrarMensaje(texto, color) {
            const el = document.getElementById('mensaje');
            el.textContent = texto;
            el.className = `mt-4 text-sm text-${color}-600`;
        }
    </script>
</body>
</html>