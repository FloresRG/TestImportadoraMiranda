<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Veripagos - Importadora Miranda</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-md mx-auto bg-white rounded shadow p-6">
        <h1 class="text-xl font-bold mb-4">Pagar con QR - BCP</h1>

        <input
            type="number"
            step="0.01"
            id="monto"
            placeholder="Monto en Bs. (ej: 10.50)"
            class="w-full p-2 border rounded mb-3"
        />

        <button onclick="generarQr()" class="w-full bg-blue-600 text-white py-2 rounded">
            Generar QR
        </button>

        <div id="qr-container" class="mt-6 hidden">
            <h2 class="font-semibold mb-2">Escanea este código:</h2>
            <img id="qr-img" class="w-full max-w-xs mx-auto border rounded" />
            <p class="text-sm text-gray-600 mt-2">
                Pedido ID: <span id="pedido-id" class="font-mono"></span>
            </p>
            <button onclick="verificarManual()" class="mt-2 text-sm text-blue-600 underline">
                Verificar manualmente
            </button>
        </div>

        <div id="mensaje" class="mt-4 min-h-[24px]"></div>
    </div>

    <script>
        let pedidoId = null;
        let eventSource = null;

        async function generarQr() {
            const monto = parseFloat(document.getElementById('monto').value);
            if (!monto || monto <= 0) {
                alert('Ingresa un monto válido');
                return;
            }

            console.log('Enviando solicitud para generar QR...', { monto });

            try {
                const res = await fetch('/veripagos/generar-qr', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ monto })
                });

                const data = await res.json();
                console.log('Respuesta generarQr:', data);

                if (data.Codigo === 0 && data.Data) {
                    document.getElementById('qr-img').src = 'image/png;base64,' + data.Data.qr;
                    // Extrae el pedido_id del lado del cliente (lo generamos en backend y devolvemos en data)
                    // Pero como no lo devuelve Veripagos, lo generamos aquí y lo enviamos:
                    // → En este ejemplo, lo simulamos con timestamp
                    pedidoId = 'pedido_' + Date.now();
                    document.getElementById('pedido-id').textContent = pedidoId;
                    document.getElementById('qr-container').classList.remove('hidden');

                    // Iniciar SSE
                    iniciarSSE(pedidoId);
                } else {
                    document.getElementById('mensaje').innerHTML = 
                        `<span class="text-red-600">❌ ${data.Mensaje || 'Error al generar QR'}</span>`;
                }
            } catch (err) {
                console.error('Error generarQr', err);
                document.getElementById('mensaje').innerHTML = 
                    '<span class="text-red-600">⚠️ Error de conexión</span>';
            }
        }

        function iniciarSSE(pedidoId) {
            console.log('Iniciando SSE para pedido:', pedidoId);
            eventSource = new EventSource(`/sse/pago/${pedidoId}`);

            eventSource.onopen = () => console.log('SSE: conexión abierta');
            eventSource.onerror = (err) => console.error('SSE error:', err);

            eventSource.addEventListener('pago_completado', (e) => {
                const data = JSON.parse(e.data);
                console.log('✅ Pago completado recibido vía SSE:', data);
                document.getElementById('mensaje').innerHTML = 
                    '<div class="p-3 bg-green-100 text-green-800 rounded text-sm">✅ ¡Pago confirmado! Gracias por tu compra.</div>';
                eventSource.close();
            });

            eventSource.addEventListener('timeout', () => {
                console.log('SSE: timeout');
                eventSource.close();
            });
        }

        async function verificarManual() {
            console.log('Verificación manual solicitada');
            // Esta función solo es de respaldo; el SSE ya maneja la actualización
            alert('La verificación en tiempo real está activa. Este botón es solo de respaldo.');
        }
    </script>
</body>
</html>