<x-app-layout>
    @section('title', 'Ubah Lembur')

    <x-breadcrumb name="admin.overtime.edit" :data="$overtime" />

    <x-card-container>
        <form action="{{ route('admin.overtime.update', $overtime->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-select label="Nama" name="user_id" id="user_id" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $employee->id == $overtime->user_id ? 'selected' : '' }}>
                        {{ $employee->name }}</option>
                @endforeach
            </x-select>
            {{-- <x-input id="duration" label="Durasi (menit)" name="duration" type="number" :value="$overtime->duration" /> --}}
            <x-input-file id="attachment" label="Lampiran" name="attachment" />
            <x-input id="start_at" label="Waktu Mulai" name="start_at" type="datetime-local" :value="$overtime->start_at" />
            <x-input id="end_at" label="Waktu Selesai" name="end_at" type="datetime-local" :value="$overtime->end_at" />
            <x-select label="Status" name="status" id="status" required>
                <option value="pending" {{ $overtime->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                <option value="approved" {{ $overtime->status == 'approved' ? 'selected' : '' }}>Disetujui</option>
                <option value="rejected" {{ $overtime->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </x-select>


            <x-button id="store" label="{{ __('Ubah') }}" type="submit" />
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
