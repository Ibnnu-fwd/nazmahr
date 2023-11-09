<x-app-layout>
    @section('title', 'Tambah Izin/Cuti')

    <x-breadcrumb name="user.permit-leave.create" />

    <x-card-container>
        <form action="{{ route('user.permit-leave.store') }}" method="POST" enctype="multipart/form-data"
            enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            <x-select id="submission_type" name="submission_type" label="Jenis" required>
                <option value="permit">Izin</option>
                <option value="leave">Cuti</option>
            </x-select>
            <x-input id="start_date" name="start_date" label="Tanggal Mulai" type="date" required />
            <x-input id="end_date" name="end_date" label="Tanggal Berakhir" type="date" required />
            <x-input-file id="attachment" name="attachment" label="Lampiran" />

            <x-textarea id="description" name="description" label="Keterangan" />

            <x-button id="store" label="{{ __('Tambah') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
