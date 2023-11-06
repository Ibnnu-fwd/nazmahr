<x-app-layout>
    @section('title', 'Presensi')

    <x-breadcrumb name="admin.attendance" />

    <x-card-container>
        <table class="rowTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Lengkap</th>
                    <th>Tanggal</th>
                    <th>Tipe Presensi</th>
                    <th>Jadwal Masuk</th>
                    <th>Jadwal Keluar</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Terlambat</th>
                    <th>Overtime</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </x-card-container>


    @push('js-internal')
        <script>
            $(function() {

                $('.rowTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    responsive: true,
                    ajax: "{{ route('admin.attendance.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'date',
                            name: 'date'
                        },
                        {
                            data: 'type',
                            name: 'type'
                        },
                        {
                            data: 'schedule_in',
                            name: 'schedule_in'
                        },
                        {
                            data: 'schedule_out',
                            name: 'schedule_out'
                        },
                        {
                            data: 'check_in',
                            name: 'check_in'
                        },
                        {
                            data: 'check_out',
                            name: 'check_out'
                        },
                        {
                            data: 'late_time',
                            name: 'late_time'
                        },
                        {
                            data: 'overtime',
                            name: 'overtime'
                        },
                    ]
                });
            });

            @include('layouts.alert')
        </script>
    @endpush
</x-app-layout>
