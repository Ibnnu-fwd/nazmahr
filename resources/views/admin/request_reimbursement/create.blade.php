<x-app-layout>
    @section('title', 'Tambah Request Reimbursement')

    <x-breadcrumb name="admin.request-reimbursement.create" />

    <x-card-container>
        <form action="{{ route('admin.request-reimbursement.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-select id="user_id" name="user_id" label="{{ __('Karyawan') }}" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </x-select>
            <x-input id="title" name="title" label="{{ __('Judul') }}" type="text" required />
            <x-input id="date" name="date" label="{{ __('Tanggal Pengajuan') }}" type="date" required />
            <x-textarea id="description" name="description" label="{{ __('Keterangan') }}" />
            <x-input id="nominal" name="nominal" label="{{ __('Nominal') }}" type="number" required />
            <x-input-file id="bill_attachment" name="bill_attachment" label="{{ __('Bukti Pengajuan') }}" type="file"
                required />
            <x-select id="status" name="status" label="{{ __('Status') }}" required>
                <option value="0">Menunggu</option>
                <option value="1">Disetujui</option>
                <option value="2">Ditolak</option>
            </x-select>

            <x-button id="store" label="{{ __('Tambah') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
