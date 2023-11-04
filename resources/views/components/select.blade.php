@props([
    'id' => '',
    'name' => '',
    'label' => '',
    'required' => false,
])

<div class="mb-4">
    <label for="{{ $id }}" class="block mb-2 text-sm font-medium text-gray-900">
        {{ $label }} {!! $required ? '<span class="text-red-500">*</span>' : '' !!}
    </label>
    <select id="{{ $id }}" name="{{ $name }}" required="{{ $required }}"
        class="text-sm block mt-1 w-full border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm">
        {{ $slot }}
    </select>
</div>
