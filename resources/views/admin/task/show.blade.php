<x-app-layout>
    @section('title', 'Detail Tugas')

    <x-breadcrumb name="admin.task.show" :data="$task" />

    <div class="max-w-xl">
        <x-card-container>
            <p class="font-semibold mb-5">
                Detail
            </p>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <p class="font-medium">Karyawan</p>
                    <p>
                        {{ $task->user->name }}
                    </p>
                </div>
                <div class="flex justify-between">
                    <p class="font-medium">Jabatan</p>
                    <p>
                        {{ $task->user->position->name }}
                    </p>
                </div>
                <div class="flex justify-between">
                    <p class="font-medium">Jenis Tugas</p>
                    <p>
                        {{ $task->task_type->name }}
                    </p>
                </div>
                <div class="flex justify-between">
                    <p class="font-medium">Judul Tugas</p>
                    <p>
                        {{ $task->title }}
                    </p>
                </div>
                <div class="flex justify-between">
                    <p class="font-medium">Tenggat</p>
                    <p>
                        {{ date('d/m/Y', strtotime($task->due_date)) }}
                    </p>
                </div>
                <div class="flex justify-between">
                    <p class="font-medium">Harga</p>
                    <p>
                        Rp {{ number_format($task->price, 0, ',', '.') }}
                    </p>
                </div>
                <div class="flex justify-between">
                    <p class="font-medium">Keterangan</p>
                    <p>
                        {{ $task->description ?? '-' }}
                    </p>
                </div>
                <div class="flex justify-between">
                    <p class="font-medium">Status</p>
                    <p>
                        {{ $task->status == 0 ? 'Menunggu' : ($task->status == 1 ? 'Dikerjakan' : ($task->status == 2 ? 'Selesai' : 'Ditolak')) }}
                    </p>
                </div>
            </div>

            {{-- @if ($task->status == 0)
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
                        {{ $task->status == 1 ? 'text-green-500' : 'text-red-500' }}
                        ">{{ $task->status == 1 ? 'menyetujui' : 'menolak' }}</span>
                    pengajuan ini pada
                    {{ date('d/m/Y', strtotime($task->updated_at)) }}
                </p>
            @endif --}}
        </x-card-container>
    </div>
    {{-- 
    @push('js-internal')
        <script>
            $(function() {
                $('#btnApprove').click(function(e) {
                    e.preventDefault();
                    let id = '{{ $task->id }}';
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
                                url: "{{ route('admin.task.change-status', ':id') }}"
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
                    let id = '{{ $task->id }}';
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
                                url: "{{ route('admin.task.change-status', ':id') }}"
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
    @endpush --}}
</x-app-layout>
