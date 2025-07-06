{{-- resources/views/client/reservation/components/modal-reservation.blade.php --}}
@props(['specialties', 'services', 'barbers'])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="relative flex w-full max-w-5xl flex-col overflow-hidden rounded-xl bg-[#2A2A2A] text-white shadow-lg md:flex-row">
  <!-- Sidebar de pasos -->
  <aside class="relative w-full md:w-1/5 bg-[#2A2A2A] p-6">
    <div class="absolute left-1/2 top-12 h-[calc(100%-4rem)] w-1 -translate-x-1/2 bg-gray-600"></div>
    <div class="relative z-10 flex justify-between md:flex-col gap-4 md:gap-12">
      <div class="step-circle active-step"></div>
      <div class="step-circle"></div>
      <div class="step-circle"></div>
      <div class="step-circle"></div>
      <div class="step-circle"></div>
    </div>
  </aside>

  <!-- Contenido wizard -->
  <section class="relative flex flex-1 flex-col overflow-auto p-6">
    <!-- Paso 1: Especialidad (selección múltiple) -->
    <div id="step1" class="wizard-step active space-y-4">
      <h2 class="text-2xl font-bold">Selecciona una o varias especialidades</h2>
      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
        @foreach($specialties as $spec)
          <button
            type="button"
            class="especialidad-btn cursor-pointer rounded border border-gray-500 p-4 transition hover:border-white hover:bg-gray-700"
            data-id="{{ $spec->id }}"
            onclick="toggleEspecialidad({{ $spec->id }}, this)"
          >
            <h3 class="font-semibold">{{ $spec->name }}</h3>
          </button>
        @endforeach
      </div>
    </div>

    <!-- Paso 2: Servicio (selección múltiple) -->
    <div id="step2" class="wizard-step hidden space-y-4">
      <h2 class="text-2xl font-bold">Elige uno o varios servicios</h2>
      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
        @foreach($services as $srv)
          <button
            type="button"
            class="servicio-btn cursor-pointer rounded border border-gray-500 p-4 transition hover:border-white hover:bg-gray-700"
            data-id="{{ $srv->id }}"
            onclick="toggleServicio({{ $srv->id }}, this)"
          >
            <h3 class="font-semibold">{{ $srv->name }}</h3>
            <p class="text-sm text-gray-400">{{ $srv->duration_minutes }} min</p>
          </button>
        @endforeach
      </div>
    </div>

    <!-- Paso 3: Barbero -->
    <div id="step3" class="wizard-step hidden space-y-4">
      <h2 class="text-2xl font-bold">Selecciona un barbero</h2>
      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
        @foreach($barbers as $barb)
          <div
            class="flex cursor-pointer items-center gap-3 rounded border border-gray-500 p-4 transition hover:border-white hover:bg-gray-700"
            onclick="seleccionarBarbero({{ $barb->id }}, '{{ $barb->name }} {{ $barb->last_name }}')"
          >
            <img src="{{ $barb->profile_photo_url }}" class="h-10 w-10 rounded-full object-cover">
            <span>{{ $barb->name }} {{ $barb->last_name }}</span>
          </div>
        @endforeach
      </div>
    </div>

    <!-- Paso 4: Fecha -->
    <div id="step4" class="wizard-step hidden space-y-4">
      <h2 class="text-xl md:text-2xl font-bold mb-4">Selecciona una fecha</h2>
      <div id="dateOptions" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
        <!-- Las fechas se generan dinámicamente -->
      </div>
    </div>

    <!-- Paso 5: Horario -->
    <div id="step5" class="wizard-step hidden space-y-4">
      <h2 class="text-xl md:text-2xl font-bold mb-4">Elige un horario</h2>
      <div id="horarios" class="flex flex-wrap gap-2">
        <!-- Los horarios se generan dinámicamente -->
      </div>
    </div>

    <!-- Navegación -->
    <div class="flex justify-end gap-4 p-4 bg-[#2A2A2A] border-t border-gray-700 absolute bottom-0 left-0 w-full">
      <button id="btnAnterior" class="px-6 py-2 text-sm bg-[#2A2A2A] text-white rounded-lg hover:bg-[#2A2A2A]/60 hidden transition">
        Anterior
      </button>
      <button id="btnSiguiente" class="px-6 py-2 text-sm bg-[#FFFFFF] text-black rounded-lg hover:bg-[#FFFFFF]/60 transition">
        Siguiente
      </button>
    </div>
  </section>

  <!-- Cerrar -->
  <button
    onclick="cerrarModalReserva()"
    class="absolute top-4 right-4 text-3xl text-white hover:text-gray-400 transition"
  >&times;</button>
</div>

<style>
  .wizard-step { display: none; }
  .wizard-step.active { display: block; }
  .step-circle {
    width: 2rem; height: 2rem;
    background: #2A2A2A; border: 2px solid #fff;
    border-radius: 9999px;
  }
  .step-circle.active-step { background: #fff; }
</style>

<script>
  let pasoActual = 1,
      totalPasos = 5,
      reserva = { especialidades: [], servicios: [] };

function actualizarWizard(){
    for(let i = 1; i <= totalPasos; i++){
      document.getElementById('step'+i).classList.toggle('active', i === pasoActual);
      document.querySelectorAll('.step-circle')[i-1].classList.toggle('active-step', i <= pasoActual);
    }
    document.getElementById('btnAnterior').style.display = pasoActual > 1 ? 'block' : 'none';
    document.getElementById('btnSiguiente').textContent = pasoActual < totalPasos ? 'Siguiente' : 'Finalizar';
    if(pasoActual === 4) generarFechas();
    if(pasoActual === 5) generarHorarios();
}

function toggleEspecialidad(id, btn) {
  const idx = reserva.especialidades.indexOf(id);
  if (idx === -1) {
    reserva.especialidades.push(id);
    btn.classList.add('ring', 'ring-blue-500');
  } else {
    reserva.especialidades.splice(idx, 1);
    btn.classList.remove('ring', 'ring-blue-500');
  }
}
function toggleServicio(id, btn) {
  const idx = reserva.servicios.indexOf(id);
  if (idx === -1) {
    reserva.servicios.push(id);
    btn.classList.add('ring', 'ring-blue-500');
  } else {
    reserva.servicios.splice(idx, 1);
    btn.classList.remove('ring', 'ring-blue-500');
  }
}
function seleccionarBarbero(id, nombreCompleto){
    reserva.barbero = { id, nombreCompleto };
    pasoActual = 4; actualizarWizard();
}
function seleccionarFecha(fecha, schedule_id) {
    reserva.fecha = fecha;
    reserva.schedule_id = schedule_id;
    pasoActual = 5;
    actualizarWizard();
}
function seleccionarHora(hora){
    reserva.hora = hora;
    pasoActual = 5; actualizarWizard();
}
function marcarHoraSeleccionada(horaSeleccionada) {
    reserva.hora = horaSeleccionada;
    // Elimina la llamada a generarHorarios() para evitar duplicados
}
function validarPaso() {
  switch(pasoActual) {
    case 1: return reserva.especialidades.length > 0;
    case 2: return reserva.servicios.length > 0;
    case 3: return !!reserva.barbero;
    case 4: return !!reserva.fecha;
    case 5: return !!reserva.hora;
    default: return true;
  }
}
document.getElementById('btnSiguiente').addEventListener('click', () => {
    if (!validarPaso()) {
      alert('Debes completar este paso antes de continuar.');
      return;
    }
    if(pasoActual < totalPasos){
      pasoActual++;
      actualizarWizard();
    } else {
      fetch('/client/reservations', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
          barber_id: reserva.barbero.id,
          services: reserva.servicios,
          specialties: reserva.especialidades,
          schedule_id: reserva.schedule_id,
          reservation_date: reserva.fecha,
          reservation_time: reserva.hora,
        })
      })
      .then(res => res.json())
      .then(data => {
        if (data.error) {
          alert('Error al guardar la reserva: ' + data.error);
        } else {
          alert('¡Reserva guardada con éxito!');
          cerrarModalReserva();
        }
      })
      .catch(() => alert('Error al guardar la reserva.'));
    }
});
document.getElementById('btnAnterior').addEventListener('click', () => {
    if(pasoActual > 1){
      pasoActual--;
      actualizarWizard();
    }
});
function generarFechas() {
    const dateOptions = document.getElementById('dateOptions');
    dateOptions.innerHTML = '';
    if (!reserva.barbero) return;
    fetch(`/client/barbers/${reserva.barbero.id}/schedules`)
        .then(res => res.json())
        .then(schedules => {
            if (!schedules.length) {
                dateOptions.innerHTML = '<div class="col-span-4 text-center text-gray-400">No hay fechas disponibles</div>';
                return;
            }
            schedules.forEach(sch => {
                const fecha = new Date(sch.date);
                const fechaStr = sch.date;
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'bg-[#FFFFFF] hover:bg-[#FFFFFF]/60 text-[#2A2A2A] px-4 py-2 rounded transition w-full';
                btn.textContent = fecha.toLocaleDateString('es-ES', { weekday: 'short', day: 'numeric', month: 'short' });
                btn.onclick = () => seleccionarFecha(fechaStr, sch.id);
                if(reserva.fecha === fechaStr) btn.classList.add('ring', 'ring-blue-500');
                dateOptions.appendChild(btn);
            });
        });
}
function generarHorarios() {
    const horariosDiv = document.getElementById('horarios');
    horariosDiv.innerHTML = '';
    if (!reserva.barbero || !reserva.fecha || !reserva.servicios.length || !reserva.schedule_id) return;
    fetch('/client/reservations/available-slots', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            barber_id: reserva.barbero.id,
            schedule_id: reserva.schedule_id,
            services: reserva.servicios
        })
    })
    .then(res => res.json())
    .then(slots => {
        if (!slots.length) {
            horariosDiv.innerHTML = '<div class="text-gray-400">No hay horarios disponibles para este día</div>';
            return;
        }
        // Filtrar horarios pasados si la fecha es hoy
        const hoy = new Date();
        const fechaSeleccionada = new Date(reserva.fecha);
        const esHoy = hoy.toISOString().slice(0,10) === reserva.fecha;
        const horaActual = hoy.getHours() + hoy.getMinutes()/60;
        let hayHorarios = false;
        slots.forEach(slot => {
            // slot.start es "HH:mm"
            if (esHoy) {
                const [h, m] = slot.start.split(":").map(Number);
                const horaSlot = h + m/60;
                if (horaSlot < horaActual) return; // Omitir horarios pasados
            }
            hayHorarios = true;
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'bg-[#FFFFFF] hover:bg-[#FFFFFF]/60 text-[#2A2A2A] px-4 py-2 rounded transition';
            btn.textContent = slot.start + ' - ' + slot.end;
            btn.onclick = () => { seleccionarHora(slot.start); marcarHoraSeleccionada(slot.start); };
            if(reserva.hora === slot.start) btn.classList.add('ring', 'ring-blue-500');
            horariosDiv.appendChild(btn);
        });
        if (!hayHorarios) {
            horariosDiv.innerHTML = '<div class="text-gray-400">No hay horarios disponibles para este día</div>';
        }
    });
}
function cerrarModalReserva(){
    location.reload();
}
actualizarWizard();
</script>