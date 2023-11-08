@props(['id' => '#', 'route' => '', 'label' => 'Tambah'])

<a type="button" id="{{ $id }}" href="{{ $route }}"
    class="text-dark bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-md text-sm px-5 py-2.5 mb-2">
    {{ $label }}
</a>
