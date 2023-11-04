<x-app-layout>
    @section('title', 'Lembur')

    <x-breadcrumb name="admin.employee" />

    <x-card-container>
        <div class="flex justify-end">
            <x-add route="{{ route('admin.overtime.create') }}" />
        </div>
        <table class="rowTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Durasi</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Berakhir</th>
                    <th>Lampiran</th>
                    <th>Status</th>
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
                            url: "{{ route('admin.overtime.destroy', ':id') }}".replace(':id', id),
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
                    ajax: "{{ route('admin.overtime.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'duration',
                            name: 'duration'
                        },
                        {
                            data: 'start_at',
                            name: 'start_at'
                        },
                        {
                            data: 'end_at',
                            name: 'end_at'
                        },
                        {
                            data: 'attachment',
                            name: 'attachment'
                        },
                        {
                            data: 'status',
                            name: 'status'
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
