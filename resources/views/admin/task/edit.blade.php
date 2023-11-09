<x-app-layout>
    @section('title', 'Ubah Tugas')

    <x-breadcrumb name="admin.task.edit" :data="$task" />

    <x-card-container>
        <form action="{{ route('admin.task.update', $task->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-select id="task_type_id" label="Jenis Tugas" class="w-full" name="task_type_id" required>
                @foreach ($taskTypes as $taskType)
                    <option value="{{ $taskType->id }}" {{ $task->task_type_id == $taskType->id ? 'selected' : '' }}>
                        {{ $taskType->name }}</option>
                @endforeach
            </x-select>
            <x-input id="title" label="Judul" type="text" name="title" required :value="$task->title" />
            <x-select id="user_id" label="Karyawan" class="w-full" name="user_id" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $task->user_id == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}</option>
                @endforeach
            </x-select>
            <x-input id="due_date" label="Tenggat" class="w-full" name="due_date" type="date" :value="$task->due_date" />
            <x-textarea id="description" label="Deskripsi" class="w-full" name="description" :value="$task->description" />
            <x-select id="status" label="Status" class="w-full" name="status" required>
                <option value="0" {{ $task->status == 0 ? 'selected' : '' }}>Menunggu</option>
                <option value="1" {{ $task->status == 1 ? 'selected' : '' }}>Dikerjakan</option>
                <option value="2" {{ $task->status == 2 ? 'selected' : '' }}>Selesai</option>
                <option value="3" {{ $task->status == 3 ? 'selected' : '' }}>Ditolak</option>
            </x-select>
            <x-input id="price" label="Harga" type="number" name="price" required :value="$task->price" />

            <x-button id="store" label="{{ __('Simpan Perubahan') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
