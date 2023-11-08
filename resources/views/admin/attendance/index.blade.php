<x-app-layout>
    @section('title', 'Presensi')

    <x-breadcrumb name="admin.attendance" />

    <x-card-container>
        <div class="flex justify-between">
            <div class="flex items-center mb-4">
                <label for="date" class="mr-2 block text-sm font-medium text-gray-700 ">Tanggal:</label>
                <input type="date" id="date" name="date" value="{{ date('Y-m-d') }}"
                    class="border-gray-300 focus:border-yellow-500 text-sm text-gray-500 focus:ring-yellow-500 rounded-md shadow-sm block w-fit">
            </div>
            <div>
                <x-add label="Tambah Manual" route="{{ route('admin.attendance.create') }}" />
            </div>
        </div>

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
            $(document).ready(function() {

                table = $('.rowTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    responsive: true,
                    ajax: {
                        url: "{{ route('admin.attendance.index') }}",
                        data: function(d) {
                            d.date = $('#date').val();
                        }
                    },
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

                $('#date').on('change', function(e) {
                    var date = $(this).val();
                    $('#date').val(date)
                    table.column(2).search(date.split('-').reverse().join('-')).draw();
                });
            });

            @include('layouts.alert')
        </script>
    @endpush
</x-app-layout>
