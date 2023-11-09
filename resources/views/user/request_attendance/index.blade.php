<x-app-layout>
    @section('title', 'Request Absensi')

    <x-breadcrumb name="user.request-attendance" />

    <x-card-container>
        <div class="flex justify-end">
            <x-add route="{{ route('user.request-attendance.create') }}" />
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
                    <th>Keterangan</th>
                    <th>Status Verifikasi</th>
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
                            url: "{{ route('user.request-attendance.destroy', ':id') }}".replace(':id', id),
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

            $(function() {

                $('.rowTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    responsive: true,
                    ajax: "{{ route('user.request-attendance.index') }}",
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
                            data: 'attendance_type',
                            name: 'attendance_type'
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
                            data: 'entry_at',
                            name: 'entry_at',
                            createdCell: function(td, cellData, rowData, row, col) {
                                if (cellData) {
                                    $(td).css('font-weight', 'bold');
                                }
                            }
                        },
                        {
                            data: 'exit_at',
                            name: 'exit_at',
                            createdCell: function(td, cellData, rowData, row, col) {
                                if (cellData) {
                                    $(td).css('font-weight', 'bold');
                                }
                            }
                        },
                        
                        {
                            data: 'description',
                            name: 'description'
                        },
                        {
                            data: 'status_verification',
                            name: 'status_verification'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            });

            @include('layouts.alert')
        </script>
    @endpush
</x-app-layout>
