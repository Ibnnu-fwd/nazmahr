<x-app-layout>
    @section('title', 'Rekap Presensi')
    <x-breadcrumb name="admin.attendance.recap" />

    <x-card-container>
        <div class="flex gap-4 items-center mb-4">
            <div class="flex items-center">
                <label for="date" class="mr-2 block text-sm font-medium text-gray-700 ">Tanggal:</label>
                <input type="month" id="date" name="date" value="{{ date('Y-m') }}" min="2021-01"
                    class="border-gray-300 focus:border-yellow-500 text-sm text-gray-500 focus:ring-yellow-500 rounded-md shadow-sm block w-fit">
            </div>
            <div class="flex items-center">
                <label for="employee" class="block mr-2 text-sm font-medium text-gray-900">
                    Karyawan:
                </label>
                <select id="employee" name="user_id"
                    class="text-sm block w-full border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm">
                    <option disabled selected>Pilih Karyawan</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
            <button id="btnRecap"
                class="text-dark bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-md text-sm px-5 py-2.5">
                Rekap
            </button>
        </div>

        <div class="resultsTable"></div>
    </x-card-container>

    @push('js-internal')
        <script>
            $(function() {
                $('#btnRecap').off('click').on('click', function(e) {
                    e.preventDefault();
                    let date = $('#date').val();
                    let user_id = $('#employee').val();
                    let url = "{{ route('admin.attendance.recap') }}";

                    console.log(date, user_id);

                    if (date == '' || date == null) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Tanggal tidak boleh kosong!',
                        });

                        return false;
                    }

                    if (user_id == '' || user_id == null) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Karyawan tidak boleh kosong!',
                        });

                        return false;
                    }

                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: {
                            date: date,
                            user_id: user_id
                        },
                        beforeSend: function() {
                            $('#btnRecap').attr('disabled', true);
                            Swal.fire({
                                title: 'Mohon Tunggu',
                                html: 'Sedang mengambil data...',
                                didOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                        },
                        success: function(res) {
                            // console.log(res);
                            $('.resultsTable').html(res);
                            $('.rowTable').DataTable().destroy();
                            $('.rowTable').DataTable({
                                responsive: true,
                                processing: true,
                                autoWidth: false,
                                pageLength: 31,
                            });
                        },
                        error: function(xhr) {
                            console.log(xhr);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: xhr.responseJSON.message,
                            });
                        },
                        complete: function() {
                            $('#btnRecap').attr('disabled', false);
                            Swal.close();
                            return false;
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
