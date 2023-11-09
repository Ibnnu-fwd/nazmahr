<x-app-layout>
    @section('title', 'Tambah Tugas')

    <x-breadcrumb name="admin.task.create" />

    <x-card-container>
        <form action="{{ route('admin.task.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-select id="task_type_id" label="Jenis Tugas" class="w-full" name="task_type_id" required>
                @foreach ($taskTypes as $taskType)
                    <option value="{{ $taskType->id }}">{{ $taskType->name }}</option>
                @endforeach
            </x-select>
            <x-input id="title" label="Judul" type="text" name="title" required />
            <x-select id="user_id" label="Karyawan" class="w-full" name="user_id" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </x-select>
            <x-input id="due_date" label="Tenggat" class="w-full" name="due_date" type="date" />
            <x-textarea id="description" label="Deskripsi" class="w-full" name="description" />
            <x-select id="status" label="Status" class="w-full" name="status" required>
                <option value="0">Menunggu</option>
                <option value="1">Dikerjakan</option>
                <option value="2">Selesai</option>
                <option value="3">Ditolak</option>
            </x-select>
            <x-input id="price" label="Harga" type="number" name="price" required />
            <x-input id="total_price" label="Total Harga" type="number" name="total_price" required />

            <x-button id="store" label="{{ __('Tambah') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
