// ==========================================================
// --- App.js de ThermoWatch: WebSockets y Funciones PWA ---
// ==========================================================

document.addEventListener('DOMContentLoaded', () => {

    // --- Configuración de WebSocket ---
    const WEBSOCKET_URL = 'ws://tu-dominio.com/ws/temp-feed'; // 🚨 ¡ACTUALIZA ESTA URL en el servidor real!
    const RECONNECT_INTERVAL = 5000;
    let ws = null;
    let reconnectTimeout = null;

    // --- Referencias UI (Basado en welcome.blade.php) ---
    // Usaremos los IDs para apuntar a las tarjetas dinámicas
    const machineCards = [
        { id: 'A01', tempElement: document.getElementById('temp-A01'), statusElement: document.getElementById('status-A01'), cardElement: document.getElementById('card-A01') },
        { id: 'B03', tempElement: document.getElementById('temp-B03'), statusElement: document.getElementById('status-B03'), cardElement: document.getElementById('card-B03') }
        // Añade aquí más máquinas dinámicamente si es necesario
    ];

    /**
     * 🌡️ Actualiza la interfaz de usuario con los datos de temperatura.
     * @param {object} data - { machineId: 'A01', temperature: 26.5, status: 'NORMAL' | 'ALERTA' }
     */
    const updateMachineStatusUI = (data) => {
        const machine = machineCards.find(m => m.id === data.machineId);

        if (!machine) return;

        // 1. Actualizar temperatura
        if (machine.tempElement) {
            machine.tempElement.textContent = `${data.temperature.toFixed(1)}`; // Deja el °C en el HTML
        }

        // 2. Actualizar estado
        if (machine.statusElement) {
            machine.statusElement.textContent = data.status === 'ALERTA' ? '¡ALERTA MÁXIMA!' : 'Normal';
        }

        // 3. Aplicar estilos de alerta (Coherente con dashboard_roles.css)
        if (machine.cardElement) {
            machine.cardElement.classList.remove('stat-alert', 'stat-normal'); // Limpia clases
            if (data.status === 'ALERTA' || data.temperature > 80) { // Lógica simple: si es Alerta o > 80°C
                machine.cardElement.classList.add('stat-alert');
            } else {
                machine.cardElement.classList.add('stat-normal');
            }
        }
    };

    /**
     * 🌐 Intenta establecer y mantener la conexión WebSocket (PWA-05).
     */
    const connectWebSocket = () => {
        // Evita múltiples intentos de reconexión si ya hay uno pendiente
        if (reconnectTimeout) {
            clearTimeout(reconnectTimeout);
            reconnectTimeout = null;
        }

        if (ws && (ws.readyState === WebSocket.OPEN || ws.readyState === WebSocket.CONNECTING)) {
            return;
        }

        console.log('🌐 WS: Intentando conectar a:', WEBSOCKET_URL);
        ws = new WebSocket(WEBSOCKET_URL);

        ws.onopen = () => {
            console.log('✅ WS: Conexión establecida. Iniciando feed de datos.');
        };

        ws.onmessage = (event) => {
            try {
                const data = JSON.parse(event.data);
                // Asume que el servidor envía un array de objetos o un objeto único
                if (Array.isArray(data)) {
                    data.forEach(updateMachineStatusUI);
                } else {
                    updateMachineStatusUI(data);
                }
            } catch (e) {
                console.error('Error al parsear mensaje de WS:', e);
            }
        };

        ws.onclose = () => {
            console.warn('❌ WS: Desconectado. Reintentando en ' + (RECONNECT_INTERVAL / 1000) + 's...');
            // Reintenta la conexión
            reconnectTimeout = setTimeout(connectWebSocket, RECONNECT_INTERVAL);
        };

        ws.onerror = (error) => {
            console.error('❌ WS Error:', error);
            // Cierra para forzar la reconexión en onclose
            if (ws.readyState !== WebSocket.CLOSED) {
                ws.close();
            }
        };
    };

    /**
     * 🔄 PWA: Intenta forzar el recacheo del Service Worker (Para versiones)
     */
    const forceServiceWorkerUpdate = () => {
        if ('serviceWorker' in navigator && navigator.serviceWorker.controller) {
            navigator.serviceWorker.controller.postMessage({
                action: 'SKIP_WAITING'
            });
            console.log('PWA: Mensaje enviado al SW para forzar la activación.');
        }
    };

    // --- Inicialización ---

    // Solo inicia el WebSocket si estamos en el dashboard (área de trabajo)
    const isWorkArea = window.location.pathname.includes('/welcome') ||
        window.location.pathname.includes('/dashboard') ||
        window.location.pathname === '/'; // Si decides que la raíz es el dashboard para autenticados

    if (isWorkArea) {
        connectWebSocket();
    }
});

// Nota: Para probar esta lógica de WebSocket, necesitas que tu servidor de Laravel
// implemente un servidor WebSocket (ej. usando Laravel Echo/Pusher o un paquete como Laravel Websockets).