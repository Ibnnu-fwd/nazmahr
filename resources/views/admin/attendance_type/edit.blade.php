<x-app-layout>
    @section('title', 'Ubah Tipe Absensi')

    <x-breadcrumb name="admin.attendance-type.update" :data="$attendanceType" />

    <x-card-container>
        <form action="{{ route('admin.attendance-type.update', $attendanceType->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-input id="name" name="name" label="{{ __('Nama') }}" type="text" required :value="$attendanceType->name" />
            <x-select id="priority" name="priority" label="{{ __('Prioritas') }}" required>
                <option value="low" {{ $attendanceType->priority == 'low' ? 'selected' : '' }}>Rendah</option>
                <option value="medium" {{ $attendanceType->priority == 'medium' ? 'selected' : '' }}>Sedang</option>
                <option value="high" {{ $attendanceType->priority == 'high' ? 'selected' : '' }}>Tinggi</option>
            </x-select>

            <x-button id="store" label="{{ __('Simpan Perubahan') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
