<x-app-layout>
    @section('title', 'Tambah Karyawan')

    <x-breadcrumb name="admin.attendance.create" />

    <x-card-container>
        <form action="{{ route('admin.attendance.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-select required id="user_id" name="user_id" label="{{ __('Nama Karyawan') }}">
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </x-select>
            <x-input required id="entry_at" label="{{ __('Jam Masuk') }}" type="datetime-local" name="entry_at" />
            <x-input required id="exit_at" label="{{ __('Jam Keluar') }}" type="datetime-local" name="exit_at" />
            <x-textarea id="description" label="{{ __('Keterangan') }}" name="description" required />
            <x-select id="status" name="status" label="{{ __('Status') }}" required>
                <option value="0">Menunggu</option>
                <option value="1">Disetujui</option>
                <option value="2">Ditolak</option>
            </x-select>


            <x-button id="store" label="{{ __('Tambah') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
