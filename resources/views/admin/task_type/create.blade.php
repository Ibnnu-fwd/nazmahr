<x-app-layout>
    @section('title', 'Tambah Tipe Tugas')

    <x-breadcrumb name="admin.task-type.create" />

    <x-card-container>
        <form action="{{ route('admin.task-type.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-input id="name" name="name" label="{{ __('Nama') }}" type="text" required />
            <x-select id="priority" name="priority" label="{{ __('Prioritas') }}" required>
                <option value="low">Rendah</option>
                <option value="medium">Sedang</option>
                <option value="high">Tinggi</option>
            </x-select>

            <x-button id="store" label="{{ __('Tambah') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
