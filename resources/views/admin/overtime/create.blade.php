<x-app-layout>
    @section('title', 'Tambah Lembur')

    <x-breadcrumb name="admin.overtime.create" />

    <x-card-container>
        <form action="{{ route('admin.overtime.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-select label="Nama" name="user_id" id="user_id" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </x-select>
            {{-- <x-input id="duration" label="Durasi (menit)" name="duration" type="number" /> --}}
            <x-input-file id="attachment" label="Lampiran" name="attachment" />
            <x-input id="start_at" label="Waktu Mulai" name="start_at" type="datetime-local" />
            <x-input id="end_at" label="Waktu Selesai" name="end_at" type="datetime-local" />
            <x-select label="Status" name="status" id="status" required>
                <option value="pending">Menunggu</option>
                <option value="approved">Disetujui</option>
                <option value="rejected">Ditolak</option>
            </x-select>

            <x-button id="store" label="{{ __('Tambah') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
