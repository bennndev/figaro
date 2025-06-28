<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<div id="reservationModal" class="fixed inset-0 z-50 bg-black/30 backdrop-blur-sm flex items-center justify-center">
    <div class="bg-[#2A2A2A] text-white rounded-xl w-full max-w-5xl shadow-lg overflow-hidden relative flex flex-col md:flex-row">
        <!-- Barra lateral de progreso vertical -->
        <aside class="w-full md:w-1/5 bg-[#2A2A2A] py-10 px-4 relative">
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 md:top-12 md:h-[calc(100%-6rem)] h-1 w-full md:w-1 bg-gray-600 z-0"></div>

            <div class="relative z-10 flex flex-row md:flex-col items-center gap-4 md:gap-12">
                <div class="step-circle active-step"></div>
                <div class="step-circle"></div>
                <div class="step-circle"></div>
                <div class="step-circle"></div>
                <div class="step-circle"></div>
            </div>
        </aside>

        <!-- Contenido principal -->
        <section class="flex-1 p-4 md:p-8 overflow-y-auto max-h-[500px] min-h-[500px]">
            <!-- Paso 1: Especialidad -->
            <div id="step1" class="wizard-step active">
                <h2 class="text-xl md:text-2xl font-bold mb-4">Selecciona una especialidad</h2>
                <input type="text" placeholder="Buscar especialidad..." class="mb-4 p-2 w-full border rounded bg-[#2A2A2A] text-white">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="border p-4 rounded shadow hover:bg-gray-600 transition cursor-pointer">
                        <h3 class="text-lg font-semibold">Degradado</h3>
                        <p class="text-gray-400 text-sm">Descripción breve...</p>
                    </div>
                    <div class="border p-4 rounded shadow hover:bg-gray-600 transition cursor-pointer">
                        <h3 class="text-lg font-semibold">Decoloración</h3>
                        <p class="text-gray-400 text-sm">Descripción breve...</p>
                    </div>
                    <div class="border p-4 rounded shadow hover:bg-gray-600 transition cursor-pointer">
                        <h3 class="text-lg font-semibold">Barba</h3>
                        <p class="text-gray-400 text-sm">Descripción breve...</p>
                    </div>
                </div>
            </div>

            <!-- Paso 2: Servicio -->
            <div id="step2" class="wizard-step hidden">
                <h2 class="text-xl md:text-2xl font-bold mb-4">Elige un servicio</h2>
                <input type="text" placeholder="Buscar servicio..." class="mb-4 p-2 w-full border rounded bg-[#2A2A2A] text-white">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="border p-4 rounded shadow hover:bg-gray-600 transition cursor-pointer">
                        <h3 class="text-lg font-semibold">Corte básico</h3>
                        <p class="text-gray-400 text-sm">Duración: 30 min</p>
                    </div>
                    <div class="border p-4 rounded shadow hover:bg-gray-600 transition cursor-pointer">
                        <h3 class="text-lg font-semibold">Lavado de cabello</h3>
                        <p class="text-gray-400 text-sm">Duración: 15 min</p>
                    </div>
                </div>
            </div>

            <!-- Paso 3: Barbero -->
            <div class="wizard-step hidden">
                <h2 class="text-xl md:text-2xl font-bold mb-4">Selecciona un barbero</h2>
                <input type="text" placeholder="Buscar barbero..." class="mb-4 p-2 w-full border rounded bg-[#2A2A2A] text-white">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @for ($i = 1; $i <= 6; $i++)
                        <div class="border p-4 rounded shadow hover:shadow-lg transition cursor-pointer flex items-center gap-4">
                            <div class="w-12 h-12 bg-gray-300 rounded-full"></div>
                            <div>
                                <h3 class="font-semibold">Barbero {{ $i }}</h3>
                                <p class="text-sm text-gray-500">Experiencia: 2 años</p>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Paso 4: Fecha -->
            <div class="wizard-step hidden">
                <h2 class="text-xl md:text-2xl font-bold mb-4">Selecciona una fecha</h2>
                <div id="dateOptions" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    <!-- Las fechas se generarán dinámicamente -->
                </div>
            </div>

            <!-- Paso 5: Horario -->
            <div class="wizard-step hidden">
                <h2 class="text-xl md:text-2xl font-bold mb-4">Elige un horario</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach (['09:00', '10:00', '11:00', '12:00', '14:00', '15:00'] as $hora)
                        <button type="button" class="bg-[#FFFFFF] hover:bg-[#FFFFFF]/60 text-[#2A2A2A] px-4 py-2 rounded transition">
                            {{ $hora }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-end gap-4 p-4 bg-[#2A2A2A] border-t border-gray-700 absolute bottom-0 left-0 w-full">
                <button id="prevStep" class="px-6 py-2 text-sm bg-[#2A2A2A] text-white rounded-lg hover:bg-[#2A2A2A]/60 hidden transition">
                    Anterior
                </button>
                <button id="nextStep" class="px-6 py-2 text-sm bg-[#FFFFFF] text-black rounded-lg hover:bg-[#FFFFFF]/60 transition">
                    Siguiente
                </button>
            </div>
        </section>

        <!-- Botón cerrar -->
        <button onclick="document.getElementById('reservationModal').classList.add('hidden')" class="absolute top-4 right-4 text-white hover:text-gray-400 text-2xl font-bold">&times;</button>
    </div>
</div>

<style>
    .wizard-step {
        display: none;
    }

    .wizard-step.active {
        display: block;
    }

    .step-circle {
        position: relative;
        width: 2rem;
        height: 2rem;
        background-color: #2A2A2A;
        border: 2px solid #FFFFFF;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .step-circle.active-step {
        background-color: #FFFFFF;
    }

    section {
        overflow-y: auto;
    }
</style>

<script>
    let currentStep = 0;
    const steps = document.querySelectorAll('.wizard-step');
    const indicators = document.querySelectorAll('.step-circle');
    const prevButton = document.getElementById('prevStep');
    const nextButton = document.getElementById('nextStep');

    function updateStep() {
        steps.forEach((s, i) => s.classList.toggle('active', i === currentStep));
        indicators.forEach((i, index) => i.classList.toggle('active-step', index <= currentStep));

        // Mostrar/ocultar botón "Anterior"
        prevButton.style.display = currentStep === 0 ? 'none' : 'block';

        // Cambiar texto del botón "Siguiente" en el último paso
        nextButton.textContent = currentStep === steps.length - 1 ? 'Finalizar' : 'Siguiente';
    }

    nextButton.addEventListener('click', () => {
        if (currentStep < steps.length - 1) {
            currentStep++;
            updateStep();
        } else {
            alert('Reserva completada');
            document.getElementById('reservationModal').classList.add('hidden');
        }
    });

    prevButton.addEventListener('click', () => {
        if (currentStep > 0) {
            currentStep--;
            updateStep();
        }
    });

    document.addEventListener('DOMContentLoaded', updateStep);

    document.addEventListener('DOMContentLoaded', function () {
        const dateOptions = document.getElementById('dateOptions');
        const today = new Date();
        const dateCards = [];

        // Generar próximas 14 fechas
        for (let i = 0; i < 14; i++) {
            const date = new Date(today);
            date.setDate(today.getDate() + i);
            const formattedDate = date.toISOString().split('T')[0]; // Formato YYYY-MM-DD

            const card = `
                <div class="border p-4 rounded shadow hover:bg-gray-600 transition cursor-pointer text-center date-card" data-date="${formattedDate}">
                    <h3 class="font-semibold text-lg">${date.toLocaleDateString('es-ES', { weekday: 'short', day: 'numeric', month: 'short' })}</h3>
                </div>
            `;
            dateCards.push(card);
        }

        // Insertar las tarjetas al DOM
        dateOptions.innerHTML = dateCards.join('');

        // Agregar evento de selección
        document.querySelectorAll('.date-card').forEach(card => {
            card.addEventListener('click', function () {
                document.querySelectorAll('.date-card').forEach(c => c.classList.remove('bg-blue-600', 'text-white'));
                this.classList.add('bg-blue-600', 'text-white');
                // Guardar la fecha seleccionada
                const selectedDate = this.dataset.date;
                console.log('Fecha seleccionada:', selectedDate);
            });
        });
    });

    function openReservationModal() {
        // Reinicia el progreso del wizard
        currentStep = 0;
        updateStep(); // Llama al método que controla el progreso

        // Limpia el modal si es necesario
        const wizardInputs = document.querySelectorAll('#reservationModal input, #reservationModal select');
        wizardInputs.forEach(input => {
            input.value = '';
        });

        // Muestra el modal
        document.getElementById('reservationModal').classList.remove('hidden');
    }
</script>
