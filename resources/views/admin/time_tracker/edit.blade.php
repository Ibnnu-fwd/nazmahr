<x-app-layout>
    @section('title', 'Ubah Data Waktu Kerja')

    <x-breadcrumb name="admin.time-tracker.edit" :data="$timeTracker" />

    <x-card-container>
        <form action="{{ route('admin.time-tracker.update', $timeTracker->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-select id="user_id" label="Karyawan" name="user_id">
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $timeTracker->user_id == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}</option>
                @endforeach
            </x-select>
            <div class="grid grid-cols-2 gap-6">
                <x-input id="start_time" label="Waktu Mulai" name="start_time" type="datetime-local" :value="$timeTracker->start_time" />
                <x-input id="end_time" label="Waktu Berakhir" name="end_time" type="datetime-local"
                    :value="$timeTracker->end_time" />
            </div>
            <x-input id="subject" label="Judul" name="subject" type="text" required :value="$timeTracker->subject" />
            <x-input id="task" label="Tugas" name="task" type="text" :value="$timeTracker->task" />

            <x-button id="store" label="{{ __('Simpan Perubahan') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
