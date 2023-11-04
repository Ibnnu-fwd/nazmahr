<x-app-layout>
    @section('title', 'Tambah Izin/Cuti')

    <x-breadcrumb name="admin.permit-leave.create" />

    <x-card-container>
        <form action="{{ route('admin.permit-leave.store') }}" method="POST" enctype="multipart/form-data"
            enctype="multipart/form-data">
            @csrf
            <x-select id="user_id" name="user_id" label="Karyawan" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </x-select>
            <x-select id="submission_type" name="submission_type" label="Jenis" required>
                <option value="permit">Izin</option>
                <option value="leave">Cuti</option>
            </x-select>
            <x-input id="start_date" name="start_date" label="Tanggal Mulai" type="date" required />
            <x-input id="end_date" name="end_date" label="Tanggal Berakhir" type="date" required />
            <x-input-file id="attachment" name="attachment" label="Lampiran" />
            <x-select id="status" name="status" label="Status" required>
                <option value="">Pilih Status</option>
                <option value="pending">Pending</option>
                <option value="approved">Disetujui</option>
                <option value="rejected">Ditolak</option>
            </x-select>
            <x-textarea id="description" name="description" label="Keterangan" />

            <x-button id="store" label="{{ __('Tambah') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
