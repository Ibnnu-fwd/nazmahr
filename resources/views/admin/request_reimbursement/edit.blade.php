<x-app-layout>
    @section('title', 'Ubah Request Reimbursement')

    <x-breadcrumb name="admin.request-reimbursement.edit" :data="$requestReimbursement" />

    <x-card-container>
        <form action="{{ route('admin.request-reimbursement.update', $requestReimbursement->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-select id="user_id" name="user_id" label="{{ __('Karyawan') }}" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}"
                        {{ $requestReimbursement->user_id == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}</option>
                @endforeach
            </x-select>
            <x-input id="title" name="title" label="{{ __('Judul') }}" type="text" required
                :value="$requestReimbursement->title" />
            <x-input id="date" name="date" label="{{ __('Tanggal Pengajuan') }}" type="date" required
                :value="$requestReimbursement->date" />
            <x-textarea id="description" name="description" label="{{ __('Keterangan') }}" :value="$requestReimbursement->description" />
            <x-input id="nominal" name="nominal" label="{{ __('Nominal') }}" type="number" required
                :value="$requestReimbursement->nominal" />
            <x-input-file id="bill_attachment" name="bill_attachment" label="{{ __('Bukti Pengajuan') }}"
                type="file" />
            <x-select id="status" name="status" label="{{ __('Status') }}" required>
                <option value="0" {{ $requestReimbursement->status == '0' ? 'selected' : '' }}>Menunggu</option>
                <option value="1" {{ $requestReimbursement->status == '1' ? 'selected' : '' }}>Disetujui</option>
                <option value="2" {{ $requestReimbursement->status == '2' ? 'selected' : '' }}>Ditolak</option>
            </x-select>

            <x-button id="store" label="{{ __('Simpan Perubahan') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
