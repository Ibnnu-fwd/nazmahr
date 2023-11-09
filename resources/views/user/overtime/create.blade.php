<x-app-layout>
    @section('title', 'Tambah Lembur')

    <x-breadcrumb name="user.overtime.create" />

    <x-card-container>
        <form action="{{ route('user.overtime.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <x-input-file id="attachment" label="Lampiran" name="attachment" />
            <x-input id="duration" label="Durasi (menit)" name="duration" type="number" />
            <x-input id="start_at" label="Waktu Mulai" name="start_at" type="datetime-local" />
            <x-input id="end_at" label="Waktu Selesai" name="end_at" type="datetime-local" />
            <x-button id="store" label="{{ __('Tambah') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
