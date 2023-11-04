<x-app-layout>
    @section('title', 'Tambah Konfigurasi Jam Kerja')

    <x-breadcrumb name="admin.attendance-time-config.create" />

    <x-card-container>
        <form action="{{ route('admin.attendance-time-config.store') }}" method="POST">
            @csrf
            <x-input id="day" name="day" label="{{ __('Hari') }}" type="text" required />
            <x-input id="start_time" name="start_time" label="{{ __('Jam Masuk') }}" type="time" required />
            <x-input id="end_time" name="end_time" label="{{ __('Jam Keluar') }}" type="time" required />
            <x-button id="store" label="{{ __('Tambah') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
