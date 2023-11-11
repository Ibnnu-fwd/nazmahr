<x-app-layout>
    @section('title', 'Presensi')

    <x-breadcrumb name="admin.attendance" />

    <x-card-container>
        <div class="flex justify-between mb-4">
            <div class="flex gap-4 items-center">
                <div class="flex items-center">
                    <label for="date" class="mr-2 block text-sm font-medium text-gray-700 ">Tanggal:</label>
                    <input type="date" id="date" name="date" value="{{ date('Y-m-d') }}"
                        class="border-gray-300 focus:border-yellow-500 text-sm text-gray-500 focus:ring-yellow-500 rounded-md shadow-sm block w-fit">
                </div>
                <div class="flex items-center">
                    <label for="employee" class="block mr-2 text-sm font-medium text-gray-900">
                        Karyawan:
                    </label>
                    <select id="employee" name="user_id"
                        class="text-sm block mt-1 w-full border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm">
                        <option disabled selected>Pilih Karyawan</option>
                        <option value="all">Semua</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <x-add label="Tambah Manual" route="{{ route('admin.attendance.create') }}" mb="mb-0" />
                <x-add label="Rekap" route="{{ route('admin.attendance.recap') }}" mb="mb-0" />
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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </x-card-container>


    @push('js-internal')
        <script>
            function btnDelete(id) {
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.attendance.destroy', ':id') }}".replace(':id',
                                id),
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Terhapus!',
                                    'Data berhasil dihapus.',
                                    'success'
                                ).then((result) => {
                                    $('.rowTable').DataTable().ajax.reload();
                                });
                            }
                        });
                    }
                })
            }

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
                            name: 'check_in',
                            createdCell: function(td, cellData, rowData, row, col) {
                                if (cellData) {
                                    $(td).css('font-weight', 'bold');
                                }
                            }
                        },
                        {
                            data: 'check_out',
                            name: 'check_out',
                            createdCell: function(td, cellData, rowData, row, col) {
                                if (cellData) {
                                    $(td).css('font-weight', 'bold');
                                }
                            }
                        },
                        {
                            data: 'late_time',
                            name: 'late_time'
                        },
                        {
                            data: 'overtime',
                            name: 'overtime'
                        },
                        {
                            data: 'action',
                            name: 'action',
                        }
                    ]
                });

                $('#date').on('change', function(e) {
                    var date = $(this).val();
                    let url = "{{ route('admin.attendance.index') }}";
                    url += '?date=' + encodeURIComponent(date);
                    // clear filter
                    $('#employee').val('all');
                    table.clear().draw();
                    table.ajax.url(url).load();
                });

                $('#employee').on('change', function(e) {
                    var employee = $(this).val();
                    let url = "{{ route('admin.attendance.index') }}";
                    url += '?employee_id=' + encodeURIComponent(employee);
                    // clear filter
                    $('#date').val('{{ date('Y-m-d') }}');
                    table.clear().draw();
                    table.ajax.url(url).load();
                });
            });

            @include('layouts.alert')
        </script>
    @endpush
</x-app-layout>
