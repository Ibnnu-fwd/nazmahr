<x-app-layout>
    @section('title', 'Payroll')

    <x-breadcrumb name="admin.payroll" />

    <x-card-container>
        <div class="flex items-center mb-4">
            <label for="date" class="mr-2 block text-sm font-medium text-gray-700 ">Bulan:</label>
            <input type="month" id="date" name="date" value="{{ date('Y-m') }}"
                class="border-gray-300 focus:border-yellow-500 text-sm text-gray-500 focus:ring-yellow-500 rounded-md shadow-sm block w-fit">
        </div>
        <table class="rowTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Karyawan</th>
                    <th>Gaji Pokok</th>
                    <th>Reimburse</th>
                    <th>Penugasan</th>
                    <th>Lembur</th>
                    <th>Total Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </x-card-container>


    @push('js-internal')
        <!-- Buttons -->
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

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
                            url: "{{ route('admin.payroll.destroy', ':id') }}".replace(':id', id),
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
                table = $('.rowTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    responsive: true,
                    ajax: "{{ route('admin.payroll.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'employee',
                            name: 'employee'
                        },
                        {
                            data: 'total_salary',
                            name: 'total_salary'
                        },
                        {
                            data: 'total_reimbursement',
                            name: 'total_reimbursement'
                        },
                        {
                            data: 'total_task',
                            name: 'total_task'
                        },
                        {
                            data: 'total_overtime',
                            name: 'total_overtime'
                        },
                        {
                            data: 'total_payroll',
                            name: 'total_payroll'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });

                new $.fn.dataTable.Buttons(table, {
                    buttons: [
                        'excel', 'print',
                    ]
                });

                table.buttons().container().appendTo($('.dataTables_filter'));

                $('#date').change(function() {
                    let date = $(this).val();
                    console.log(date);
                    let url = "{{ route('admin.payroll.index') }}";
                    let newUrl = url + '?date=' + date;
                    table.clear().draw();
                    $('.rowTable').DataTable().ajax.url(newUrl).load();
                });
            });

            @include('layouts.alert')
        </script>
    @endpush
</x-app-layout>
