<x-app-layout>
    @section('title', 'Detail Izin/Cuti')

    <x-breadcrumb name="admin.permit-leave.show" :data="$permitLeave" />

    <div class="max-w-xl">
        <x-card-container>
            <p class="mb-5">
                {{ $permitLeave->user->name }} ingin mengajukan izin/cuti pada tanggal:
            </p>
            <div class="flex items-center justify-between mb-2">
                <p class="font-medium">
                    Tanggal Mulai
                </p>
                <p>
                    {{ Carbon\Carbon::parse($permitLeave->start_date)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                </p>
            </div>
            <div class="flex items-center justify-between mb-2">
                <p class="font-medium">
                    Tanggal Selesai
                </p>
                <p>
                    {{ Carbon\Carbon::parse($permitLeave->end_date)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                </p>
            </div>
            <div class="flex items-center justify-between mb-2">
                <p class="font-medium">
                    Lampiran
                </p>
                <p>
                    @if ($permitLeave->attachment)
                        <a class="hover:underline hover:text-yellow-600"
                            href="{{ asset('storage/permit-leave/' . $permitLeave->attachment) }}" target="_blank">
                            ↗ {{ $permitLeave->attachment }}
                        </a>
                    @else
                        -
                    @endif
                </p>
            </div>
            <hr class="my-4">
            <p class="font-medium mb-2">
                Keterangan
            </p>
            <p>
                {{ $permitLeave->description }}
            </p>
            <hr class="my-4">
            @if ($permitLeave->status == 'pending')
                <p class="font-medium mb-2 mt-5">
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
                        {{ $permitLeave->status == 'approved' ? 'text-green-500' : 'text-red-500' }}
                        ">{{ $permitLeave->status == 'approved' ? 'menyetujui' : 'menolak' }}</span>
                    pengajuan ini pada
                    {{ date('d/m/Y', strtotime($permitLeave->updated_at)) }}
                </p>
            @endif
        </x-card-container>
    </div>

    @push('js-internal')
        <script>
            $(function() {
                $('#btnApprove').click(function(e) {
                    e.preventDefault();
                    let id = '{{ $permitLeave->id }}';
                    let status = 'approved';

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
                                url: "{{ route('admin.permit-leave.change-status', ':id') }}"
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
                    let id = '{{ $permitLeave->id }}';
                    let status = 'rejected';

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
                                url: "{{ route('admin.permit-leave.change-status', ':id') }}"
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
