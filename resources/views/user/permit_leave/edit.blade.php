<x-app-layout>
    @section('title', 'Ubah Izin/Cuti')

    <x-breadcrumb name="user.permit-leave.edit" :data="$permitLeave" />

    <x-card-container>
        <form action="{{ route('user.permit-leave.update', $permitLeave->id) }}" method="POST"
            enctype="multipart/form-data" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            <x-select id="submission_type" name="submission_type" label="Jenis" required>
                <option value="permit" {{ $permitLeave->submission_type == 'permit' ? 'selected' : '' }}>Izin</option>
                >Izin</option>
                <option value="leave" {{ $permitLeave->submission_type == 'leave' ? 'selected' : '' }}>Cuti</option>
                >Cuti</option>
            </x-select>
            <x-input id="start_date" name="start_date" label="Tanggal Mulai" type="date" required
                :value="$permitLeave->start_date" />
            <x-input id="end_date" name="end_date" label="Tanggal Berakhir" type="date" required
                :value="$permitLeave->end_date" />
            <x-input-file id="attachment" name="attachment" label="Lampiran" />

            <x-textarea id="description" name="description" label="Keterangan" :value="$permitLeave->description" />

            <x-button id="store" label="{{ __('Simpan Perubahan') }}" type="submit" />
        </form>
    </x-card-container>

    @push('js-internal')
        <script>
            $(function() {
                @if ($permitLeave->attachment != null)
                    // append small label to attachment input
                    $('#attachment').parent().append(
                        '<small class="text-sm text-gray-500">Kosongkan jika tidak ingin mengubah lampiran</small>'
                    );
                @else
                    // append small label to attachment input
                    $('#attachment').parent().append(
                        '<small class="text-sm text-gray-500">Lampiran belum tersedia</small>'
                    );
                @endif
            });
        </script>
    @endpush

</x-app-layout>
