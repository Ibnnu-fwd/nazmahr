<x-app-layout>
    @section('title', 'Tambah Request Reimbursement')

    <x-breadcrumb name="user.request-reimbursement.create" />

    <x-card-container>
        <form action="{{ route('user.request-reimbursement.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <x-input id="title" name="title" label="{{ __('Judul') }}" type="text" required />
            <x-input id="date" name="date" label="{{ __('Tanggal Pengajuan') }}" type="date" required />
            <x-textarea id="description" name="description" label="{{ __('Keterangan') }}" />
            <x-input id="nominal" name="nominal" label="{{ __('Nominal') }}" type="number" required />
            <x-input-file id="bill_attachment" name="bill_attachment" label="{{ __('Bukti Pengajuan') }}" type="file"
                required />
            <x-button id="store" label="{{ __('Tambah') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
