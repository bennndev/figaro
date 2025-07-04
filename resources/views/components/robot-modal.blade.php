<div>
  {{-- Botón flotante con imagen del robot --}}
 <style>
  /* Borde platinado con efecto degradado */
  .border-platinum {
    border: 2px solid transparent;
    background-clip: padding-box;
    border-radius: 9999px;
    background-image: 
      linear-gradient(#1E1E1E, #1E1E1E), /* fondo interno */
      linear-gradient(120deg, #e0e0e0, #f5f5f5, #c0c0c0); /* borde platinado */
    background-origin: padding-box, border-box;
    background-repeat: no-repeat;
  }

  /* Efecto de vidrio */
  .glass-button {
    backdrop-filter: blur(10px);
    background-color: rgba(255, 255, 255, 0.05);
  }

  /* Animación de latido */
  @keyframes heartbeat {
    0%, 100% {
      transform: scale(1);
    }
    50% {
      transform: scale(1.1);
    }
  }

  .animate-heartbeat {
    animation: heartbeat 1.5s infinite ease-in-out;
  }
</style>

<!-- Botón flotante con estilo vidrio y borde platinado -->
<button id="chatButton"
  class="fixed bottom-6 right-6 w-24 h-24 z-50 rounded-full p-0 glass-button border-platinum animate-heartbeat draggable">
  <img src="{{ asset('images/robot.svg') }}"
    alt="Botón Chat"
    class="w-full h-full object-contain invert"
    draggable="false"
    onmousedown="return false" />
</button>

  {{-- Modal del asistente --}}
<div id="chatModal" class="fixed inset-0 z-40 hidden flex items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-[#2A2A2A] w-[90%] max-w-xl rounded-xl shadow-2xl flex flex-col overflow-hidden">
      <!-- Header -->
      <div class="flex items-center justify-between px-4 py-3 bg-[#1E1E1E]">
        <h2 class="text-lg font-bold text-white">Figaro Assistant</h2>
        <button onclick="toggleChat()" class="text-white text-2xl hover:text-gray-300">&times;</button>
      </div>

      <!-- Chat box -->
      <div class="p-4 space-y-3 h-64 overflow-y-auto bg-gray-50 text-black" id="assistant-messages">
        <div class="text-sm text-gray-600 text-center">¡Hola! Soy Figaro Assistant. ¿En qué puedo ayudarte?</div>

        @foreach($history as $msg)
          <div class="mb-3 {{ $msg['role'] === 'user' ? 'text-right' : 'text-left' }}">
            <div class="inline-block px-4 py-2 rounded
              {{ $msg['role'] === 'user'
                 ? 'bg-blue-100 text-blue-800'
                 : 'bg-green-50 text-gray-800' }}">
              <strong>{{ $msg['role'] === 'user' ? 'Tú' : 'Figaro' }}:</strong>
              {!! nl2br(e($msg['content'])) !!}
            </div>
          </div>
        @endforeach
      </div>

      <!-- Formulario -->
      <form id="assistant-form" action="{{ route('client.assistant.ask') }}" method="POST" class="bg-[#1E1E1E] p-4 flex gap-2">
        @csrf
        <textarea name="prompt" id="assistant-prompt"
          class="flex-1 p-2 rounded bg-[#333] text-sm focus:outline-none text-white"
          rows="2" placeholder="Escribe tu mensaje...">{{ old('prompt') }}</textarea>
        <button type="submit"
          class="bg-white text-[#2A2A2A] px-4 py-2 rounded font-semibold hover:bg-gray-200 transition">
          Enviar
        </button>
      </form>
    </div>
  </div>

  @push('scripts')
<script>
  const btn = document.getElementById('chatButton');
  const modal = document.getElementById('chatModal');
  const form = document.getElementById('assistant-form');
  const container = document.getElementById('assistant-messages');

  let isDragging = false;
  let isModalOpen = false;
  let offsetX = 0;
  let offsetY = 0;
  let preventClick = false;

  function toggleChat() {
    modal.classList.toggle('hidden');
    isModalOpen = !modal.classList.contains('hidden');

    if (isModalOpen) {
      btn.style.left = 'auto';
      btn.style.top = 'auto';
      btn.style.right = '1.5rem';
      btn.style.bottom = '1.5rem';
      btn.style.zIndex = '10';
      btn.style.pointerEvents = 'none';
    } else {
      btn.style.zIndex = '50';
      btn.style.pointerEvents = 'auto';
    }
  }

  function startDrag(e) {
    if (isModalOpen) return;

    isDragging = true;
    preventClick = false;

    const clientX = e.type.includes('touch') ? e.touches[0].clientX : e.clientX;
    const clientY = e.type.includes('touch') ? e.touches[0].clientY : e.clientY;
    offsetX = clientX - btn.getBoundingClientRect().left;
    offsetY = clientY - btn.getBoundingClientRect().top;

    btn.style.transition = 'none';
  }

  function onDrag(e) {
    if (!isDragging || isModalOpen) return;

    preventClick = true;

    const clientX = e.type.includes('touch') ? e.touches[0].clientX : e.clientX;
    const clientY = e.type.includes('touch') ? e.touches[0].clientY : e.clientY;

    const newX = clientX - offsetX;
    const newY = clientY - offsetY;

    const maxX = window.innerWidth - btn.offsetWidth;
    const maxY = window.innerHeight - btn.offsetHeight;

    btn.style.left = `${Math.min(Math.max(0, newX), maxX)}px`;
    btn.style.top = `${Math.min(Math.max(0, newY), maxY)}px`;
    btn.style.right = 'auto';
    btn.style.bottom = 'auto';
  }

  function endDrag(e) {
    if (!isDragging) return;
    isDragging = false;
    btn.style.transition = '';

    // Bloquear el clic siguiente solo si se arrastró
    if (preventClick) {
      setTimeout(() => {
        preventClick = false;
      }, 100);
    }
  }

  btn.addEventListener('click', () => {
    if (!preventClick && !isModalOpen) {
      toggleChat();
    }
  });

  // Eventos para PC
  btn.addEventListener('mousedown', startDrag);
  document.addEventListener('mousemove', onDrag);
  document.addEventListener('mouseup', endDrag);

  // Eventos para móvil
  btn.addEventListener('touchstart', startDrag);
  document.addEventListener('touchmove', onDrag);
  document.addEventListener('touchend', endDrag);

  // Enviar mensaje AJAX
  form.addEventListener('submit', async e => {
    e.preventDefault();
    const data = new FormData(form);
    const resp = await fetch(form.action, {
      method: 'POST',
      headers: { 'Accept': 'application/json' },
      body: new URLSearchParams(data)
    });

    const json = await resp.json();
    if (!resp.ok) {
      alert(json.errors.prompt?.[0] ?? json.message);
      return;
    }

    form.prompt.value = '';
    container.innerHTML = '';
    json.history.forEach(m => {
      const side = m.role === 'user' ? 'text-right' : 'text-left';
      const bg   = m.role === 'user' ? 'bg-blue-100 text-blue-800' : 'bg-green-50 text-gray-800';
      container.innerHTML += `
        <div class="mb-3 ${side}">
          <div class="inline-block px-4 py-2 rounded ${bg}">
            <strong>${m.role === 'user' ? 'Tú' : 'Figaro'}:</strong>
            ${m.content.replace(/\n/g, '<br>')}
          </div>
        </div>`;
    });

    container.scrollTop = container.scrollHeight;
  });
</script>


  @endpush
</div>
