<x-app-layout>
    @section('title', 'Ubah Karyawan')

    <x-breadcrumb name="admin.profile.edit" />

    <x-card-container>
        <form action="{{ route('admin.profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-input id="name" name="name" label="{{ __('Nama lengkap') }}" type="text" required
                :value="$user->name" />
            <x-select id="gender" name="gender" label="Jenis Kelamin" required>
                <option value="L" {{ $user->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ $user->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
            </x-select>
            <x-input id="email" name="email" label="{{ __('Email') }}" type="email" required
                :value="$user->email" />
            <x-input id="birth" name="birth" label="{{ __('Tanggal lahir') }}" type="date" required
                :value="$user->birth" />
            <x-input id="phone" name="phone" label="{{ __('No. Telepon') }}" type="text" required
                :value="$user->phone" />
            <x-textarea id="address" name="address" label="{{ __('Alamat') }}" required :value="$user->address" />
            <x-input-file id="photo" name="photo" label="{{ __('Foto') }}" type="file" :value="$user->photo" />
            <x-input-file id="ktp" name="ktp" label="{{ __('KTP') }}" type="file" :value="$user->ktp" />

            <x-button id="store" label="{{ __('Simpan Perubahan') }}" type="submit" />
        </form>
    </x-card-container>

    @push('js-internal')
        <script>
            $(function() {
                @if ($user->photo != null)
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

                @if ($user->ktp != null)
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
