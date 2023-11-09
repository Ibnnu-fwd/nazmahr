<x-app-layout>
    @section('title', 'Ubah Request Reimbursement')

    <x-breadcrumb name="user.request-reimbursement.edit" :data="$requestReimbursement" />

    <x-card-container>
        <form action="{{ route('user.request-reimbursement.update', $requestReimbursement->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            <x-input id="title" name="title" label="{{ __('Judul') }}" type="text" required
                :value="$requestReimbursement->title" />
            <x-input id="date" name="date" label="{{ __('Tanggal Pengajuan') }}" type="date" required
                :value="$requestReimbursement->date" />
            <x-textarea id="description" name="description" label="{{ __('Keterangan') }}" :value="$requestReimbursement->description" />
            <x-input id="nominal" name="nominal" label="{{ __('Nominal') }}" type="number" required
                :value="$requestReimbursement->nominal" />
            <x-input-file id="bill_attachment" name="bill_attachment" label="{{ __('Bukti Pengajuan') }}"
                type="file" />
            <x-button id="store" label="{{ __('Simpan Perubahan') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
