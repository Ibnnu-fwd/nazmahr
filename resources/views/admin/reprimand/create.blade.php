<x-app-layout>
    @section('title', 'Tambah Surat Peringatan')

    <x-breadcrumb name="admin.reprimand.create" />

    <x-card-container>
        <form action="{{ route('admin.reprimand.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-select id="user_id" label="{{ __('Karyawan') }}" class="w-full" name="user_id" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </x-select>
            <x-select id="reprimand_type" label="{{ __('Jenis') }}" class="w-full" name="reprimand_type" required>
                <option value="SP1">SP1</option>
                <option value="SP2">SP2</option>
                <option value="SP3">SP3</option>
            </x-select>
            <x-input id="start_date" label="{{ __('Tanggal Mulai') }}" type="date" name="start_date" />
            <x-input id="end_date" label="{{ __('Tanggal Berakhir') }}" type="date" name="end_date" />
            <x-input-file id="attachment" label="{{ __('Lampiran') }}" name="attachment" />
            <x-textarea id="content" label="{{ __('Keterangan') }}" name="content" required />
            <div class="flex items-center mb-4">
                <input id="is_send_email" type="checkbox" value="1" name="is_send_email"
                    class="w-4 h-4 text-checkbox-600 bg-gray-100 border-gray-300 rounded focus:ring-checkbox-500">
                <label for="is_send_email" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Kirim email?
                </label>
            </div>

            <x-button id="store" label="{{ __('Tambah') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
