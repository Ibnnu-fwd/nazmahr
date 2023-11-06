<x-app-layout>
    @section('title', 'Ubah Tipe Absensi')

    <x-breadcrumb name="admin.attendance-type.edit" :data="$attendanceType" />

    <x-card-container>
        <form action="{{ route('admin.attendance-type.update', $attendanceType->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-input id="name" name="name" label="{{ __('Nama') }}" type="text" required :value="$attendanceType->name" />
            <x-button id="store" label="{{ __('Simpan Perubahan') }}" type="submit" />
        </form>
    </x-card-container>
</x-app-layout>
