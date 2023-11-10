<x-app-layout>
    @section('title', 'Tambah Karyawan')

    <x-breadcrumb name="admin.employee.create" />

    <x-card-container>
        <form action="{{ route('admin.employee.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-input id="name" name="name" label="{{ __('Nama lengkap') }}" type="text" required />
            <x-select id="gender" name="gender" label="Jabatan" required>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </x-select>
            <x-input id="email" name="email" label="{{ __('Email') }}" type="email" required />
            <x-input id="birth" name="birth" label="{{ __('Tanggal lahir') }}" type="date" required />
            <x-input id="phone" name="phone" label="{{ __('No. Telepon') }}" type="text" required />
            <x-textarea id="address" name="address" label="{{ __('Alamat') }}" required />
            <x-input-file id="photo" name="photo" label="{{ __('Foto') }}" type="file" required />
            <x-input-file id="ktp" name="ktp" label="{{ __('KTP') }}" type="file" required />
            <x-select id="position_id" name="position_id" label="Jabatan" required>
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                @endforeach
            </x-select>
            <x-select id="employee_status" name="employee_status" label="Status Karyawan" required>
                <option value="probation">Probation</option>
                <option value="permanent">Permanent</option>
                <option value="internship">Internship</option>
            </x-select>
            <x-input id="salary" name="salary" label="{{ __('Gaji') }}" type="number" required />

            <x-button id="store" label="{{ __('Tambah') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
