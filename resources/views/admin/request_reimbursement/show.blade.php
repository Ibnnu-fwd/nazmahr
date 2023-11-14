<x-app-layout>
    @section('title', 'Detail Request Reimbursement')

    <x-breadcrumb name="admin.request-reimbursement.show" :data="$requestReimbursement" />

    <div class="max-w-xl">
        <x-card-container>
            <p class="font-semibold mb-5">
                Detail
            </p>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <p class="font-medium">Karyawan</p>
                    <p>
                        {{ $requestReimbursement->user->name }}
                    </p>
                </div>
                <div class="flex justify-between">
                    <p class="font-medium">Jabatan</p>
                    <p>
                        {{ $requestReimbursement->user->position->name }}
                    </p>
                </div>
                <div class="flex justify-between">
                    <p class="font-medium">Judul</p>
                    <p>
                        {{ $requestReimbursement->title }}
                    </p>
                </div>
                <div class="flex justify-between">
                    <p class="font-medium">Nominal</p>
                    <p>
                        Rp {{ number_format($requestReimbursement->nominal, 0, ',', '.') }}
                    </p>
                </div>
                <div class="flex justify-between">
                    <p class="font-medium">Lampiran</p>
                    @if ($requestReimbursement->bill_attachment)
                        <a href="{{ asset('storage/reimbursement/bill' . $requestReimbursement->bill_attachment) }}"
                            target="_blank" class="text-blue-600 hover:underline">
                            Lihat lampiran
                        </a>
                    @else
                        <p class="text-gray-400">
                            -
                        </p>
                    @endif
                </div>
                <div class="flex justify-between">
                    <p class="font-medium">Keterangan</p>
                    <p>
                        {{ $requestReimbursement->description ?? '-' }}
                    </p>
                </div>
            </div>

            @if ($requestReimbursement->status == 0)
                <p class="font-medium mb-5 mt-5">
                    Ubah Status
                </p>
                <div class="flex items-center gap-x-2">
                    <x-add id="btnApprove" label="Setuju" />
                    <x-add id="btnReject" label="Tolak" />
                </div>
            @else
                <p class="mt-5">
                    Anda telah <span
                        class="font-semibold
                        {{ $requestReimbursement->status == 1 ? 'text-green-500' : 'text-red-500' }}
                        ">{{ $requestReimbursement->status == 1 ? 'menyetujui' : 'menolak' }}</span>
                    pengajuan ini pada
                    {{ date('d/m/Y', strtotime($requestReimbursement->updated_at)) }}
                </p>
            @endif
        </x-card-container>
    </div>

    @push('js-internal')
        <script>
            $(function() {
                $('#btnApprove').click(function(e) {
                    e.preventDefault();
                    let id = {{ $requestReimbursement->id }};
                    let status = 1;

                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Anda tidak dapat mengembalikan data yang telah diubah!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, setuju!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "{{ route('admin.request-reimbursement.change-status', ':id') }}"
                                    .replace(':id', id),
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    status: status
                                },
                                dataType: "json",
                                success: function(response) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Status pengajuan berhasil diubah',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(function() {
                                        window.location.reload();
                                    });
                                }
                            });
                        }
                    })
                });

                $('#btnReject').click(function(e) {
                    e.preventDefault();
                    let id = {{ $requestReimbursement->id }};
                    let status = 2;

                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Anda tidak dapat mengembalikan data yang telah diubah!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, tolak!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "{{ route('admin.request-reimbursement.change-status', ':id') }}"
                                    .replace(':id', id),
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    status: status
                                },
                                dataType: "json",
                                success: function(response) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Status pengajuan berhasil diubah',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(function() {
                                        window.location.reload();
                                    });
                                }
                            });
                        }
                    })
                });
            });
        </script>
    @endpush
</x-app-layout>
