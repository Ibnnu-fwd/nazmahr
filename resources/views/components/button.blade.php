@props([
    'label' => '',
    'id' => '',
    'type' => 'button',
])

<button type="{{ $type }}" id="{{ $id }}"
    class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-md text-sm px-5 py-2.5 mb-2">
    {{ $label }}
</button>
