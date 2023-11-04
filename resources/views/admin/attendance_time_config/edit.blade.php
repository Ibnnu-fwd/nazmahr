<x-app-layout>
    @section('title', 'Ubah Konfigurasi Jam Kerja')

    <x-breadcrumb name="admin.attendance-time-config.edit" :data="$attendanceTimeConfig" />

    <x-card-container>
        <form action="{{ route('admin.attendance-time-config.update', $attendanceTimeConfig->id) }}" method="POST">
            @csrf
            @method('PUT')
            <x-input id="day" name="day" label="{{ __('Hari') }}" type="text" :value="$attendanceTimeConfig->day" required />
            <x-input id="start_time" name="start_time" label="{{ __('Jam Masuk') }}" type="time" :value="$attendanceTimeConfig->start_time"
                required />
            <x-input id="end_time" name="end_time" label="{{ __('Jam Keluar') }}" type="time" :value="$attendanceTimeConfig->end_time"
                required />
            <x-button id="store" label="{{ __('Ubah') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
