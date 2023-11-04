<x-app-layout>
    @section('title', 'Ubah Kasbon')

    <x-breadcrumb name="admin.casbon.edit" :data="$casbon" />

    <x-card-container>
        <form action="{{ route('admin.casbon.update', $casbon->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-select id="user_id" name="user_id" label="{{ __('Karyawan') }}" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $casbon->user_id == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}</option>
                @endforeach
            </x-select>
            <x-input id="date" name="date" label="{{ __('Tanggal Pengembalian') }}" type="date" required
                :value="$casbon->date" />
            <x-input id="nominal" name="nominal" label="{{ __('Nominal') }}" type="number" required
                :value="$casbon->nominal" />
            <x-input-file id="refund_attachment" name="refund_attachment" label="{{ __('Lampiran Pengembalian') }}"
                type="file" />
            <x-input-file id="application_attachment" name="application_attachment"
                label="{{ __('Lampiran Pengajuan') }}" type="file" />
            <x-textarea id="description" name="description" label="{{ __('Keterangan') }}" required :value="$casbon->description" />
            <x-select id="status" name="status" label="{{ __('Status') }}" required>
                <option value="pending" {{ $casbon->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                <option value="approved" {{ $casbon->status == 'approved' ? 'selected' : '' }}>Disetujui</option>
                <option value="rejected" {{ $casbon->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </x-select>

            <x-button id="store" label="{{ __('Simpan Perubahan') }}" type="submit" />
        </form>
    </x-card-container>

    @push('js-internal')
        <script>
            $(function() {
                @if ($casbon->refund_attachment != null)
                    // append small label to photo input
                    $('#refund_attachment').parent().append(
                        '<small class="text-sm text-gray-500">Kosongkan jika tidak ingin mengubah foto</small>'
                    );
                @else
                    // append small label to photo input
                    $('#refund_attachment').parent().append(
                        '<small class="text-sm text-gray-500">Lampiran pengembalian kasbon belum tersedia</small>'
                    );
                @endif

                @if ($casbon->application_attachment != null)
                    // append small label to photo input
                    $('#application_attachment').parent().append(
                        '<small class="text-sm text-gray-500">Kosongkan jika tidak ingin mengubah foto</small>'
                    );
                @else
                    // append small label to photo input
                    $('#application_attachment').parent().append(
                        '<small class="text-sm text-gray-500">Lampiran pengajuan kasbon belum tersedia</small>'
                    );
                @endif
            });
        </script>
    @endpush
</x-app-layout>
