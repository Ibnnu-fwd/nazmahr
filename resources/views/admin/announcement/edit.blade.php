<x-app-layout>
    @section('title', 'Ubah Pengumuman')

    <x-breadcrumb name="admin.announcement.edit" :data="$announcement" />

    <x-card-container>
        <form action="{{ route('admin.announcement.update', $announcement->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-input id="subject" name="subject" label="{{ __('Judul') }}" type="text" required :value="$announcement->subject" />
            <x-textarea id="content" name="content" label="{{ __('Konten') }}" :value="$announcement->content" />
            <x-input-file id="attachment" name="attachment" label="{{ __('Lampiran') }}" />
            <div class="flex items-center mb-4">
                <input id="is_send_email" type="checkbox" value="1" name="is_send_email"
                    class="w-4 h-4 text-checkbox-600 bg-gray-100 border-gray-300 rounded focus:ring-checkbox-500">
                <label for="is_send_email" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Kirim email?
                </label>
            </div>
            <x-select id="is_active" name="is_active" label="{{ __('Status') }}" required>
                <option value="1" {{ $announcement->is_active ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ !$announcement->is_active ? 'selected' : '' }}>Tidak Aktif</option>
            </x-select>
            <x-button id="store" label="{{ __('Simpan Perubahan') }}" type="submit" />
        </form>
    </x-card-container>

    @push('js-internal')
        <!--  CKEditor  -->
        <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
        <script>
            $(function() {
                // set height editor
                $('#content').css('min-height', '300px');
                // init editor
                ClassicEditor
                    .create(document.querySelector('#content'))
                    .catch(error => {
                        console.error(error);
                    });
                @if ($announcement->is_send_email)
                    $('#is_send_email').prop('checked', true);
                @endif
                @if ($announcement->attachment)
                    $('#attachment').parent().append(`
                        <small class="block mt-2 text-xs text-gray-600 dark:text-gray-400">
                            <a href="{{ asset('storage/announcement/' . $announcement->attachment) }}" target="_blank">
                                {{ $announcement->attachment }}
                            </a>
                        </small>
                    `);
                @else
                    $('#attachment').parent().append(`
                        <small class="block mt-2 text-xs text-gray-600 dark:text-gray-400">
                            Belum ada lampiran.
                        </small>
                    `);
                @endif
            });
        </script>
    @endpush

</x-app-layout>
