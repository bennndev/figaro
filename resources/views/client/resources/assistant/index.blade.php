<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Asistente Virtual') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <!-- Chat Container -->
                <div id="assistant-messages" class="h-96 p-4 overflow-y-auto bg-gray-50">
                    <div class="text-center text-gray-500 text-sm py-4">
                        ¡Hola! Soy Figaro Assistant. ¿En qué puedo ayudarte con tus reservas o servicios?
                    </div>
                </div>
                
                <!-- Formulario -->
                <form id="assistant-form" action="{{ route('client.assistant.ask') }}" method="POST" class="border-t border-gray-200 p-4 bg-white">
                    @csrf
                    <div class="flex flex-col space-y-2">
                        <div>
                            <textarea
                                id="assistant-prompt"
                                name="prompt"
                                class="w-full border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('prompt') border-red-500 @enderror"
                                rows="3"
                                placeholder="Escribe tu pregunta aquí..."
                                required
                            >{{ old('prompt') }}</textarea>
                            
                            @error('prompt')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex justify-end">
                            <button
                                type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50"
                            >
                                Enviar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
document.getElementById('assistant-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const form = e.target;
    const promptInput = document.getElementById('assistant-prompt');
    const prompt = promptInput.value.trim();
    const button = form.querySelector('button[type="submit"]');
    const messagesContainer = document.getElementById('assistant-messages');

    // Limpiar errores anteriores
    document.querySelectorAll('.text-red-600').forEach(el => el.remove());
    promptInput.classList.remove('border-red-500');

    if (!prompt) {
        showError('Por favor escribe tu pregunta');
        return;
    }

    button.disabled = true;
    button.innerHTML = 'Enviando...';

    // Mostrar pregunta
    messagesContainer.innerHTML += `
        <div class="text-right mb-4">
            <div class="inline-block max-w-md bg-blue-100 text-blue-800 rounded-lg px-4 py-2">
                <strong>Tú:</strong> ${escapeHtml(prompt)}
            </div>
        </div>
    `;
    messagesContainer.scrollTop = messagesContainer.scrollHeight;

    try {
        const formData = new FormData(form);
        const response = await fetch(form.action, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: new URLSearchParams(formData)
        });

        const data = await response.json();
        
        if (!response.ok) {
            if (data.errors?.prompt) {
                showError(data.errors.prompt[0]);
            } else {
                throw new Error(data.message || 'Error en el servidor');
            }
            return;
        }

        // Mostrar respuesta
        messagesContainer.innerHTML += `
            <div class="text-left mb-4">
                <div class="inline-block max-w-md bg-green-50 text-gray-800 rounded-lg px-4 py-2">
                    <strong class="text-green-600">Figaro:</strong> ${escapeHtml(data.reply)}
                </div>
            </div>
        `;
        
    } catch (error) {
        showError('Error de conexión. Inténtalo nuevamente.');
        console.error('Error:', error);
    } finally {
        button.disabled = false;
        button.innerHTML = 'Enviar';
        promptInput.value = '';
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
});

function showError(message) {
    const errorElement = document.createElement('p');
    errorElement.className = 'mt-1 text-sm text-red-600';
    errorElement.textContent = message;
    
    const promptContainer = document.getElementById('assistant-prompt').parentNode;
    promptContainer.appendChild(errorElement);
    document.getElementById('assistant-prompt').classList.add('border-red-500');
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
    </script>
    @endpush
</x-app-layout>