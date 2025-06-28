@props(['id', 'type' => 'text', 'name', 'label', 'value' => ''])

<div>
  <label for="{{ $id }}" class="block text-sm font-medium mb-1">{{ $label }}</label>
  <input id="{{ $id }}" type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}"
         class="w-full px-4 py-2 bg-[#444]/50 text-white border border-gray-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-white"
         {{ $attributes }}>
</div>
