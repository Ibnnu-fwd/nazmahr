<x-app-layout>
    @section('title', 'Ubah Request Absensi')

    <x-breadcrumb name="admin.request-attendance.edit" :data="$requestAttendance" />

    <x-card-container>
        <form action="{{ route('admin.request-attendance.update', $requestAttendance->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-select id="user_id" label="Karyawan" class="w-full" name="user_id" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </x-select>
            <x-select id="attendance_type_id" name="attendance_type_id" label="{{ __('Tipe Absensi') }}" required>
                @foreach ($attendanceTypes as $attendanceType)
                    <option value="{{ $attendanceType->id }}">{{ $attendanceType->name }}</option>
                @endforeach
            </x-select>
            <x-input id="entry_at" name="entry_at" label="{{ __('Jam Masuk') }}" type="datetime-local" required :value="$requestAttendance->entry_at" />
            <x-input id="exit_at" name="exit_at" label="{{ __('Jam Keluar') }}" type="datetime-local" required :value="$requestAttendance->exit_at"/>
            <x-input id="description" name="description" label="{{ __('Keterangan') }}" type="text" required :value="$requestAttendance->description"/>
            <x-button id="store" label="{{ __('Simpan Perubahan') }}" type="submit" />
        </form>
    </x-card-container>
</x-app-layout>
