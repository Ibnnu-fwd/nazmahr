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
            <x-select id="attendance_time_config_id" name="attendance_time_config_id" label="{{ __('Jadwal') }}"
                required :value="$requestAttendance->attendanceTimeConfig">
                @foreach ($attendanceTimeConfigs as $attendanceTimeConfig)
                    <option value="{{ $attendanceTimeConfig->id }}">{{ $attendanceTimeConfig->day }}</option>
                @endforeach
            </x-select>
            <x-input id="entry_at" name="entry_at" label="{{ __('Jam Masuk') }}" type="datetime-local" required
                :value="$requestAttendance->entry_at" min="{{ now()->format('Y-m-d\TH:i') }}" />
            <x-input id="exit_at" name="exit_at" label="{{ __('Jam Keluar') }}" type="datetime-local" required
                :value="$requestAttendance->exit_at" min="{{ now()->format('Y-m-d\TH:i') }}" />
            <x-select id="status_verification" name="status_verification" label="{{ __('Status') }}" required
                :value="$requestAttendance->status_verification">
                <option value="pending" {{ $requestAttendance->status_verification == 'Pending' ? 'selected' : '' }}>
                    {{ __('Menunggu') }}</option>
                <option value="confirmed"
                    {{ $requestAttendance->status_verification == 'Confirmed' ? 'selected' : '' }}>
                    {{ __('Disetujui') }}</option>
                <option value="rejected" {{ $requestAttendance->status_verification == 'Rejected' ? 'selected' : '' }}>
                    {{ __('Ditolak') }}</option>
            </x-select>
            <x-input id="description" name="description" label="{{ __('Keterangan') }}" type="text" required
                :value="$requestAttendance->description" />
            <x-button id="store" label="{{ __('Simpan Perubahan') }}" type="submit" />
        </form>
    </x-card-container>
</x-app-layout>
