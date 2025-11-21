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
        </div>

        <div id="mensaje" class="mt-4 min-h-[24px]"></div>
    </div>

    <script>
        let eventSource = null;

        async function generarQr() {
            const monto = parseFloat(document.getElementById('monto').value);
            if (!monto || monto <= 0) {
                alert('Ingresa un monto válido');
                return;
            }

            document.getElementById('mensaje').innerHTML = '<span class="text-blue-600">_generando QR...</span>';

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

                if (data.Codigo === 0 && data.Data && data.pedido_id) {
                    document.getElementById('qr-img').src = 'data:image/png;base64,' + data.Data.qr;
                    document.getElementById('pedido-id').textContent = data.pedido_id;
                    document.getElementById('qr-container').classList.remove('hidden');
                    document.getElementById('mensaje').innerHTML = '';

                    // Iniciar SSE con el ID real del backend
                    iniciarSSE(data.pedido_id);
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
            if (eventSource) eventSource.close();

            eventSource = new EventSource(`/sse/pago/${pedidoId}`);

            eventSource.onopen = () => console.log('SSE: conexión abierta');
            eventSource.onerror = (err) => {
                console.error('SSE error:', err);
                document.getElementById('mensaje').innerHTML = 
                    '<span class="text-orange-600">⚠️ Error en conexión en tiempo real</span>';
            };

            eventSource.addEventListener('pago_completado', (e) => {
                const data = JSON.parse(e.data);
                document.getElementById('mensaje').innerHTML = 
                    '<div class="p-3 bg-green-100 text-green-800 rounded text-sm">✅ ¡Pago confirmado! Gracias por tu compra.</div>';
                eventSource.close();
            });

            eventSource.addEventListener('timeout', () => {
                eventSource.close();
                if (!document.getElementById('mensaje').innerHTML.includes('✅')) {
                    document.getElementById('mensaje').innerHTML = 
                        '<span class="text-gray-600">⏳ Tiempo de espera agotado. Verifica manualmente.</span>';
                }
            });
        }
    </script>
</body>
</html>