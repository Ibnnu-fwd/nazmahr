@props(['id' => '#', 'onclick' => ''])

<a type="button" id="{{ $id }}" onclick="{{ $onclick }}"
    class="text-red-600 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-md text-sm px-2.5 py-2.5 mr-2 mb-2 cursor-pointer">
    <img src="{{ asset('assets/icon-button/x-circle-svgrepo-com.svg') }}" class="w-4 h-4" alt="">
</a>
