<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl">{{ __('Asistente Virtual') }}</h2>
  </x-slot>

  <div class="py-6 max-w-3xl mx-auto space-y-4">
    {{-- Chat Box --}}
    <div id="assistant-messages" class="h-80 overflow-y-auto p-4 bg-gray-50 rounded">
      <div class="text-center text-gray-500">¡Hola! Soy Figaro Assistant. ¿En qué puedo ayudarte?</div>

      @foreach($history as $msg)
        <div class="mb-3 {{ $msg['role']==='user' ? 'text-right' : 'text-left' }}">
          <div class="inline-block px-4 py-2 rounded 
            {{ $msg['role']==='user' 
               ? 'bg-blue-100 text-blue-800' 
               : 'bg-green-50 text-gray-800' }}">
            <strong>{{ $msg['role']==='user' ? 'Tú' : 'Figaro' }}:</strong>
            {!! nl2br(e($msg['content'])) !!}
          </div>
        </div>
      @endforeach
    </div>

    {{-- Formulario --}}
    <form id="assistant-form" action="{{ route('client.assistant.ask') }}" method="POST">
      @csrf
      <textarea name="prompt" id="assistant-prompt"
        class="w-full border rounded p-2" rows="3"
        placeholder="Escribe tu pregunta...">{{ old('prompt') }}</textarea>
      @error('prompt') <p class="text-red-600">{{ $message }}</p> @enderror

      <div class="mt-2 text-right">
        <button type="submit"
          class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
          Enviar
        </button>
      </div>
    </form>
  </div>

  @push('scripts')
  <script>
    const form = document.getElementById('assistant-form');
    const container = document.getElementById('assistant-messages');

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
        alert(json.errors.prompt[0] ?? json.message);
        return;
      }

      // Limpiar textarea
      form.prompt.value = '';

      // Renderizamos TODO el historial
      container.innerHTML = '';
      json.history.forEach(m => {
        const side = m.role==='user' ? 'text-right' : 'text-left';
        const bg   = m.role==='user' ? 'bg-blue-100 text-blue-800' : 'bg-green-50 text-gray-800';
        container.innerHTML += `
          <div class="mb-3 ${side}">
            <div class="inline-block px-4 py-2 rounded ${bg}">
              <strong>${m.role==='user'?'Tú':'Figaro'}:</strong>
              ${m.content.replace(/\n/g,'<br>')}
            </div>
          </div>`;
      });

      container.scrollTop = container.scrollHeight;
    });
  </script>
  @endpush
</x-app-layout>
