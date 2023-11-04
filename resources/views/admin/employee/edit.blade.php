<x-app-layout>
    @section('title', 'Ubah Karyawan')

    <x-breadcrumb name="admin.employee.edit" :data="$employee" />

    <x-card-container>
        <form action="{{ route('admin.employee.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-input id="name" name="name" label="{{ __('Nama lengkap') }}" type="text" required
                :value="$employee->name" />
            <x-select id="gender" name="gender" label="Jabatan" required>
                <option value="L" {{ $employee->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ $employee->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
            </x-select>
            <x-input id="email" name="email" label="{{ __('Email') }}" type="email" required
                :value="$employee->email" />
            <x-input id="birth" name="birth" label="{{ __('Tanggal lahir') }}" type="date" required
                :value="$employee->birth" />
            <x-input id="phone" name="phone" label="{{ __('No. Telepon') }}" type="text" required
                :value="$employee->phone" />
            <x-textarea id="address" name="address" label="{{ __('Alamat') }}" required :value="$employee->address" />
            <x-input-file id="photo" name="photo" label="{{ __('Foto') }}" type="file" :value="$employee->photo" />
            <x-input-file id="ktp" name="ktp" label="{{ __('KTP') }}" type="file" :value="$employee->ktp" />
            <x-select id="position_id" name="position_id" label="Jabatan" required>
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}"
                        {{ $employee->position_id == $position->id ? 'selected' : '' }}>
                        {{ $position->name }}</option>
                @endforeach
            </x-select>

            <x-button id="store" label="{{ __('Simpan Perubahan') }}" type="submit" />
        </form>
    </x-card-container>

    @push('js-internal')
        <script>
            $(function() {
                @if ($employee->photo != null)
                    // append small label to photo input
                    $('#photo').parent().append(
                        '<small class="text-sm text-gray-500">Kosongkan jika tidak ingin mengubah foto</small>'
                    );
                @else
                    // append small label to photo input
                    $('#photo').parent().append(
                        '<small class="text-sm text-gray-500">Foto belum tersedia</small>'
                    );
                @endif

                @if ($employee->ktp != null)
                    // append small label to ktp input
                    $('#ktp').parent().append(
                        '<small class="text-sm text-gray-500">Kosongkan jika tidak ingin mengubah ktp</small>');
                @else
                    // append small label to ktp input
                    $('#ktp').parent().append(
                        '<small class="text-sm text-gray-500">Ktp belum tersedia</small>');
                @endif
            });
        </script>
    @endpush

</x-app-layout>
