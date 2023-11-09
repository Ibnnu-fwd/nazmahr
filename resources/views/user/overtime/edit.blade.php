<x-app-layout>
    @section('title', 'Ubah Lembur')

    <x-breadcrumb name="user.overtime.edit" :data="$overtime" />

    <x-card-container>
        <form action="{{ route('user.overtime.update', $overtime->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <x-input-file id="attachment" label="Lampiran" name="attachment" />
            <x-input id="duration" label="Durasi (menit)" name="duration" type="number" :value="$overtime->duration" />
            <x-input id="start_at" label="Waktu Mulai" name="start_at" type="datetime-local" :value="$overtime->start_at" />
            <x-input id="end_at" label="Waktu Selesai" name="end_at" type="datetime-local" :value="$overtime->end_at" />
            <x-button id="store" label="{{ __('Simpan Perubahan') }}" type="submit" />
        </form>
    </x-card-container>

    @push('js-internal')
        <script>
            $(function() {
                @if ($overtime->attachment != null)
                    // append small label to photo input
                    $('#attachment').parent().append(
                        '<small class="text-sm text-gray-500">Kosongkan jika tidak ingin mengubah lampiran</small>'
                    );
                @else
                    // append small label to photo input
                    $('#attachment').parent().append(
                        '<small class="text-sm text-gray-500">Lampiran belum tersedia</small>'
                    );
                @endif
            });
        </script>
    @endpush

</x-app-layout>
