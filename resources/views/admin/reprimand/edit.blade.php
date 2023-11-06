<x-app-layout>
    @section('title', 'Ubah Surat Peringatan')

    <x-breadcrumb name="admin.reprimand.edit" :data="$reprimand" />

    <x-card-container>
        <form action="{{ route('admin.reprimand.update', $reprimand->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-select id="user_id" label="{{ __('Karyawan') }}" class="w-full" name="user_id" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $reprimand->user_id == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}</option>
                @endforeach
            </x-select>
            <x-select id="reprimand_type" label="{{ __('Jenis') }}" class="w-full" name="reprimand_type" required>
                <option value="SP1" {{ $reprimand->reprimand_type == 'SP1' ? 'selected' : '' }}>SP1</option>
                <option value="SP2" {{ $reprimand->reprimand_type == 'SP2' ? 'selected' : '' }}>SP2</option>
                <option value="SP3" {{ $reprimand->reprimand_type == 'SP3' ? 'selected' : '' }}>SP3</option>
            </x-select>
            <x-input id="start_date" label="{{ __('Tanggal Mulai') }}" type="date" name="start_date"
                value="{{ $reprimand->start_date }}" />
            <x-input id="end_date" label="{{ __('Tanggal Berakhir') }}" type="date" name="end_date"
                value="{{ $reprimand->end_date }}" />
            <x-input-file id="attachment" label="{{ __('Lampiran') }}" name="attachment" />
            <x-textarea id="content" label="{{ __('Keterangan') }}" name="content" required :value="$reprimand->content" />
            <div class="flex items-center mb-4">
                <input id="is_send_email" type="checkbox" value="1" name="is_send_email"
                    class="w-4 h-4 text-checkbox-600 bg-gray-100 border-gray-300 rounded focus:ring-checkbox-500">
                <label for="is_send_email" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Kirim email?
                </label>
            </div>

            <x-button id="store" label="{{ __('Simpan Perubahan') }}" type="submit" />
        </form>
    </x-card-container>

    @push('js-internal')
        <script>
            $(function() {
                @if ($reprimand->is_send_email)
                    $('#is_send_email').prop('checked', true);
                @endif

                @if ($reprimand->attachment)
                    $('#attachment').parent().append(`
                        <a target="_blank" href="{{ asset('storage/reprimand/' . $reprimand->attachment) }}" class="text-gray-500 block mt-2">{{ $reprimand->attachment }}</a>
                    `);
                @else
                    $('#attachment').parent().append(`
                        <span class="text-gray-500">Lampiran tidak tersedia</span>
                    `);
                @endif
            });
        </script>
    @endpush

</x-app-layout>
