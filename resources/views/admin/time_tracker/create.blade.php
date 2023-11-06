<x-app-layout>
    @section('title', 'Tambah Data Waktu Kerja')

    <x-breadcrumb name="admin.time-tracker.create" />

    <x-card-container>
        <form action="{{ route('admin.time-tracker.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-select id="user_id" label="Karyawan" name="user_id">
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </x-select>
            <div class="grid grid-cols-2 gap-6">
                <x-input id="start_time" label="Waktu Mulai" name="start_time" type="datetime-local" />
                <x-input id="end_time" label="Waktu Berakhir" name="end_time" type="datetime-local" />
            </div>
            <x-input id="subject" label="Judul" name="subject" type="text" required />
            <x-input id="task" label="Tugas" name="task" type="text" />

            <x-button id="store" label="{{ __('Tambah') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
