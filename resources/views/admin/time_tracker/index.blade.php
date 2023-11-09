<x-app-layout>
    @section('title', 'Time Tracker')

    <x-breadcrumb name="admin.time-tracker" />

    <x-card-container>
        <div class="flex justify-end">
            <x-add route="{{ route('admin.time-tracker.create') }}" />
        </div>
        <table class="rowTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Karyawan</th>
                    <th>Judul</th>
                    <th>Tugas</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Berakhir</th>
                    <th>Durasi</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Tombol</th>
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
                            url: "{{ route('admin.time-tracker.destroy', ':id') }}".replace(':id', id),
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

            function btnContinue(id) {
                let url = "{{ route('admin.time-tracker.continue', ':id') }}".replace(':id', id);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $('.rowTable').DataTable().ajax.reload();
                    }
                });
            }

            function btnStop(id) {
                let url = "{{ route('admin.time-tracker.stop', ':id') }}".replace(':id', id);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $('.rowTable').DataTable().ajax.reload();
                    }
                });
            }

            function btnStart(id) {
                let url = "{{ route('admin.time-tracker.start', ':id') }}".replace(':id', id);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $('.rowTable').DataTable().ajax.reload();
                    }
                });
            }

            function btnFinish(id) {
                let url = "{{ route('admin.time-tracker.finish', ':id') }}".replace(':id', id);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $('.rowTable').DataTable().ajax.reload();
                    }
                });
            }

            $(function() {
                $('.rowTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    responsive: true,
                    ajax: "{{ route('admin.time-tracker.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'user',
                            name: 'user'
                        },
                        {
                            data: 'subject',
                            name: 'subject'
                        },
                        {
                            data: 'task',
                            name: 'task'
                        },
                        {
                            data: 'start_time',
                            name: 'start_time'
                        },
                        {
                            data: 'end_time',
                            name: 'end_time'
                        },
                        {
                            data: 'total_time',
                            name: 'total_time'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'button',
                            name: 'button'
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
