<x-app-layout>
    @section('title', 'Detail Presensi')

    <x-breadcrumb name="admin.attendance.show" :data="$attendance" />

    <div class="max-w-lg mx-auto">
        <x-card-container>
            <div class="flex justify-between items-center">
                <h1 class="font-semibold">
                    Detail Presensi
                </h1>
            </div>
            <hr class="my-4">
            <table class="table border-none">
                <tr>
                    <td class="font-semibold w-40">Karyawan</td>
                    <td>:</td>
                    <td>
                        {{ $attendance->user->name }}
                    </td>
                </tr>
                <tr>
                    <td class="font-semibold w-40">Posisi</td>
                    <td>:</td>
                    <td>
                        {{ $attendance->user->position->name }}
                    </td>
                </tr>
                <tr>
                    <td class="font-semibold w-40">Lokasi</td>
                    <td>:</td>
                    <td>
                        {{ $attendance->location ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="font-semibold w-40">Koordinat</td>
                    <td>:</td>
                    <td>
                        {{ $attendance->latitude ?? '-' }}, {{ $attendance->longitude ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="font-semibold w-40">Tanggal</td>
                    <td>:</td>
                    <td>
                        {{ Carbon\Carbon::parse($attendance->entry_at)->format('d F Y') }}
                    </td>
                </tr>
                <tr>
                    <td class="font-semibold w-40">Absensi Masuk</td>
                    <td>:</td>
                    <td>
                        {{ $attendance->entry_at ? Carbon\Carbon::parse($attendance->entry_at)->format('H:i') . ' WIB' : '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="font-semibold w-40">Absensi Keluar</td>
                    <td>:</td>
                    <td>
                        {{ $attendance->exit_at ? Carbon\Carbon::parse($attendance->exit_at)->format('H:i') . ' WIB' : '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="font-semibold w-40">Catatan</td>
                    <td>:</td>
                    <td>
                        {{ $attendance->description ?? '-' }}
                    </td>
                </tr>
            </table>
        </x-card-container>
    </div>
</x-app-layout>
