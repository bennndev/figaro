// Variables globales del wizard
let currentStep = 0;
let especialidadId = null;

function getSteps() {
    return [
        document.getElementById('step1')
    ];
}
function getIndicators() {
    return []; // No necesitas indicadores por ahora
}
function updateStep() {
    const steps = getSteps();
    steps.forEach((s, i) => s.classList.toggle('active', i === currentStep));
    // No hay indicadores ni botones previos
    const nextButton = document.getElementById('nextStep');
    if (nextButton) {
        nextButton.textContent = 'Siguiente';
    }
}

function setupWizardNavigation() {
    const nextButton = document.getElementById('nextStep');
    if (!nextButton) return;

    nextButton.onclick = async () => {
        const select = document.getElementById('especialidadSelect');
        especialidadId = select ? select.value : null;
        if (!especialidadId) return alert('Selecciona una especialidad');
        alert('Especialidad seleccionada: ' + especialidadId);
        document.getElementById('reservationModal').classList.add('hidden');
    };
}

async function cargarEspecialidades() {
    const select = document.getElementById('especialidadSelect');
    console.log('Select:', select); // <-- Debug
    if (!select) return;
    select.innerHTML = '<option value="">Cargando...</option>';
    const res = await fetch('/client/specialties');
    const data = await res.json();
    console.log('Data:', data); // <-- Debug
    select.innerHTML = '<option value="">-- Selecciona --</option>';
    data.forEach(e => {
        select.innerHTML += `<option value="${e.id}">${e.name}</option>`;
    });
}

function openReservationModal() {
    currentStep = 0;
    updateStep();
    especialidadId = null;
    const especialidadSelect = document.getElementById('especialidadSelect');
    if (especialidadSelect) especialidadSelect.value = '';
    cargarEspecialidades();
    document.getElementById('reservationModal').classList.remove('hidden');
}

window.openReservationModal = openReservationModal;

document.addEventListener('DOMContentLoaded', function () {
    updateStep();
    setupWizardNavigation();
});