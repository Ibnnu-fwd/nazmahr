<x-app-layout>
    @section('title', 'Tambah Tipe Absensi')

    <x-breadcrumb name="admin.attendance-type.create" />

    <x-card-container>
        <form action="{{ route('admin.attendance-type.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-input id="name" name="name" label="{{ __('Nama') }}" type="text" required />
            <x-button id="store" label="{{ __('Tambah') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
