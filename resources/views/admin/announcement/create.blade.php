<x-app-layout>
    @section('title', 'Tambah Pengumuman')

    <x-breadcrumb name="admin.announcement.create" />

    <x-card-container>
        <form action="{{ route('admin.announcement.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-input id="subject" name="subject" label="{{ __('Judul') }}" type="text" required />
            <x-textarea id="content" name="content" label="{{ __('Konten') }}" />
            <x-input-file id="attachment" name="attachment" label="{{ __('Lampiran') }}" />
            <div class="flex items-center mb-4">
                <input id="is_send_email" type="checkbox" value="1" name="is_send_email"
                    class="w-4 h-4 text-checkbox-600 bg-gray-100 border-gray-300 rounded focus:ring-checkbox-500">
                <label for="is_send_email" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Kirim email?
                </label>
            </div>
            <x-select id="is_active" name="is_active" label="{{ __('Status') }}" required>
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
            </x-select>
            <x-button id="store" label="{{ __('Tambah') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
