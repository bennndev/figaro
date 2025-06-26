@props(['type' => 'submit'])

<button type="{{ $type }}"
  class="px-6 py-2 bg-white text-[#1E1E1E] font-semibold rounded-lg hover:bg-gray-300 transition">
  {{ $slot }}
</button>
