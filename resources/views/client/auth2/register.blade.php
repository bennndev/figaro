<x-auth-layout title="Registro">
  {{-- Botón de volver fuera del contenedor --}}
  <div class="absolute top-6 left-6 z-10">
    <a href="{{ url('/') }}" class="flex items-center gap-2 text-gray-400 hover:text-white transition">
      <i class="bi bi-arrow-left"></i>
      <span class="text-sm">Volver</span>
    </a>
  </div>
  
  <x-auth-card>
    <h2 class="text-2xl font-bold text-center mb-6">Registro</h2>

    {{-- Los errores se manejan con SweetAlert en el layout --}}

    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="space-y-5" id="formRegistro">
      @csrf

      {{-- Paso 1 --}}
      <div id="step1" class="space-y-4">
        <div class="grid sm:grid-cols-2 gap-3">
          <div>
            <label class="block mb-1 text-sm">Nombre</label>
            <input type="text" name="name"
                   class="w-full px-3 py-2 bg-[#444]/50 text-white border border-gray-500 rounded-lg"
                   required>
            {{-- Los errores se manejan con SweetAlert --}}
          </div>
          <div>
            <label class="block mb-1 text-sm">Apellido</label>
            <input type="text" name="last_name"
                   class="w-full px-3 py-2 bg-[#444]/50 text-white border border-gray-500 rounded-lg"
                   required>
            {{-- Los errores se manejan con SweetAlert --}}
          </div>
        </div>

        <div>
          <label class="block mb-1 text-sm">Teléfono</label>
          <input type="text" name="phone_number"
                 class="w-full px-3 py-2 bg-[#444]/50 text-white border border-gray-500 rounded-lg"
                 required>
          {{-- Los errores se manejan con SweetAlert --}}
        </div>

        <input type="hidden" name="role" value="client">

        <div class="flex justify-end">
          <button type="button" onclick="nextStep()"
                  class="bg-white text-[#1E1E1E] px-6 py-2 rounded-lg hover:bg-gray-300 font-semibold">
            Siguiente
          </button>
        </div>

        <!-- Botón de Google -->
        <div class="flex justify-center mt-3">
          <a href="{{ route('auth.google.redirect') }}"
             class="w-10 h-10 flex items-center justify-center rounded-full border border-white/30 bg-transparent hover:bg-white/10 transition">
            <i class="bi bi-google google-icon text-xl text-white"></i>
          </a>
        </div>

        <!-- Enlace para iniciar sesión -->
        <p class="text-center text-sm mt-5">
          ¿Ya tienes cuenta?
          <a href="{{ route('login') }}" class="underline">Inicia sesión</a>
        </p>
      </div>

      {{-- Paso 2 --}}
      <div id="step2" class="space-y-4 hidden">
        <div>
          <label class="block mb-1 text-sm">Correo electrónico</label>
          <input type="email" name="email"
                 class="w-full px-3 py-2 bg-[#444]/50 text-white border border-gray-500 rounded-lg"
                 required>
          {{-- Los errores se manejan con SweetAlert --}}
        </div>

        <div class="grid sm:grid-cols-2 gap-3">
          <div>
            <label class="block mb-1 text-sm">Contraseña</label>
            <input type="password" name="password"
                   class="w-full px-3 py-2 bg-[#444]/50 text-white border border-gray-500 rounded-lg"
                   required>
            {{-- Los errores se manejan con SweetAlert --}}
          </div>
          <div>
            <label class="block mb-1 text-sm">Confirmar contraseña</label>
            <input type="password" name="password_confirmation"
                   class="w-full px-3 py-2 bg-[#444]/50 text-white border border-gray-500 rounded-lg"
                   required>
          </div>
        </div>

        <div class="flex justify-between">
          <button type="button" onclick="prevStep()"
                  class="px-5 py-2 border border-white rounded-lg hover:bg-white hover:text-black text-sm">
            Atrás
          </button>
          <button type="button" onclick="nextStep2()"
                  class="bg-white text-black px-6 py-2 rounded-lg font-semibold hover:bg-gray-300">
            Siguiente
          </button>
        </div>
      </div>

      {{-- Paso 3 --}}
      <div id="step3" class="space-y-4 hidden">
        <div class="flex flex-col items-center space-y-2">
          <i class="bi bi-person-fill-add text-5xl text-white/80"></i>
          <label class="text-sm">Sube tu foto de perfil</label>
          <input type="file" name="profile_photo" accept="image/*"
                 class="block text-sm text-white file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-white file:text-black hover:file:bg-gray-300">
          {{-- Los errores se manejan con SweetAlert --}}
        </div>

        <div class="flex justify-between">
          <button type="button" onclick="prevStep2()"
                  class="px-5 py-2 border border-white rounded-lg hover:bg-white hover:text-black text-sm">
            Atrás
          </button>
          <button type="submit"
                  class="bg-white text-black px-6 py-2 rounded-lg font-semibold hover:bg-gray-300">
            Registrarse
          </button>
        </div>
      </div>
    </form>
  </x-auth-card>

  {{-- Script de pasos --}}
  <script>
    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');
    const step3 = document.getElementById('step3');

    function nextStep() {
      step1.classList.add('hidden');
      step2.classList.remove('hidden');
    }

    function prevStep() {
      step2.classList.add('hidden');
      step1.classList.remove('hidden');
    }

    function nextStep2() {
      step2.classList.add('hidden');
      step3.classList.remove('hidden');
    }

    function prevStep2() {
      step3.classList.add('hidden');
      step2.classList.remove('hidden');
    }
  </script>
</x-auth-layout>
