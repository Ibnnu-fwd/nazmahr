<x-app-layout>
    @section('title', 'Ubah Tugas')

    <x-breadcrumb name="user.task.edit" :data="$task" />

    <x-card-container>
        <form action="{{ route('user.task.update', $task->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-select id="status" label="Status" class="w-full" name="status" required>
                <option value="0" {{ $task->status == 0 ? 'selected' : '' }}>Menunggu</option>
                <option value="1" {{ $task->status == 1 ? 'selected' : '' }}>Dikerjakan</option>
                <option value="2" {{ $task->status == 2 ? 'selected' : '' }}>Selesai</option>
                <option value="3" {{ $task->status == 3 ? 'selected' : '' }}>Ditolak</option>
            </x-select>
            <x-button id="store" label="{{ __('Simpan Perubahan') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
