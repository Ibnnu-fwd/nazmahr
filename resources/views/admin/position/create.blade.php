<x-app-layout>
    @section('title', 'Tambah Jabatan')

    <x-breadcrumb name="admin.position.create" />

    <x-card-container>
        <form action="{{ route('admin.position.store') }}" method="POST">
            @csrf
            <x-input id="name" name="name" label="{{ __('Jabatan') }}" type="text" required />
            <x-button id="store" label="{{ __('Tambah') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
