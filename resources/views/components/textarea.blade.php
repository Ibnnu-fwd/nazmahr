@props([
    'id' => '#',
    'label' => 'Label',
    'name' => 'name',
    'value' => '',
    'required' => false,
])

<div class="mb-4">
    <label for="{{ $id }}"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}
        {!! $required ? '<span class="text-red-500">*</span>' : '' !!}</label>
    <textarea id="{{ $id }}" rows="4" name="{{ $name }}" required="{{ $required }}"
        class="text-sm block mt-1 w-full border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm">{{ $value }}</textarea>
</div>
