<x-app-layout>
    @section('title', 'Tambah Kasbon')

    <x-breadcrumb name="admin.casbon.create" />

    <x-card-container>
        <form action="{{ route('admin.casbon.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-select id="user_id" name="user_id" label="{{ __('Karyawan') }}" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </x-select>
            <x-input id="date" name="date" label="{{ __('Tanggal Pengembalian') }}" type="date" required />
            <x-input id="nominal" name="nominal" label="{{ __('Nominal') }}" type="number" required />
            <x-input-file id="refund_attachment" name="refund_attachment" label="{{ __('Lampiran Pengembalian') }}"
                type="file" />
            <x-input-file id="application_attachment" name="application_attachment"
                label="{{ __('Lampiran Pengajuan') }}" type="file" />
            <x-textarea id="description" name="description" label="{{ __('Keterangan') }}" />
            <x-select id="status" name="status" label="{{ __('Status') }}" required>
                <option value="pending">Menunggu</option>
                <option value="approved">Disetujui</option>
                <option value="rejected">Ditolak</option>
            </x-select>

            <x-button id="store" label="{{ __('Tambah') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
