<x-app-layout>
    @section('title', 'Ubah Tipe Tugas')

    <x-breadcrumb name="admin.task-type.update" :data="$taskType" />

    <x-card-container>
        <form action="{{ route('admin.task-type.update', $taskType->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-input id="name" name="name" label="{{ __('Nama') }}" type="text" required :value="$taskType->name" />
            <x-select id="priority" name="priority" label="{{ __('Prioritas') }}" required>
                <option value="low" {{ $taskType->priority == 'low' ? 'selected' : '' }}>Rendah</option>
                <option value="medium" {{ $taskType->priority == 'medium' ? 'selected' : '' }}>Sedang</option>
                <option value="high" {{ $taskType->priority == 'high' ? 'selected' : '' }}>Tinggi</option>
            </x-select>

            <x-button id="store" label="{{ __('Simpan Perubahan') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
