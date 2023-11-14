<x-app-layout>

    @section('title', 'Rekap Gaji Bulanan')

    <x-breadcrumb name="admin.payroll.monthly-recap" :data="[$month, $monthlyRecap]" />

    <div class="grid grid-cols-2 gap-4">
        <x-card-container>
            <p class="font-semibold text-yellow-600 px-3">
                Pendapatan
            </p>

            <div class="flex justify-between items-start mt-4 px-3 py-1">
                <div>
                    <p class="text-sm">
                        Gaji Pokok
                    </p>
                </div>
                <p class="text-sm text-gray-500 font-semibold">
                    Rp {{ number_format($monthlyRecap->total_salary, 0, ',', '.') }}
                </p>
            </div>
            <div class="flex justify-between items-start px-3 py-1">
                <div>
                    <p class="text-sm">
                        Reimburse
                    </p>
                </div>
                <p class="text-sm text-gray-500 font-semibold">
                    Rp {{ number_format($monthlyRecap->total_reimbursement, 0, ',', '.') }}
                </p>
            </div>
            <div class="flex justify-between items-start px-3 py-1">
                <div>
                    <p class="text-sm">
                        Penugasan
                    </p>
                </div>
                <p class="text-sm text-gray-500 font-semibold">
                    Rp {{ number_format($monthlyRecap->total_task, 0, ',', '.') }}
                </p>
            </div>
            <div class="rounded-md bg-gray-100 py-3 px-3 mt-4">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm">
                            Total Pendapatan
                        </p>
                    </div>
                    <p class="text-sm text-gray-500 font-semibold">
                        Rp {{ number_format($monthlyRecap->total_payroll, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </x-card-container>
        <x-card-container>
            <p class="font-semibold text-yellow-600 px-3 mb-4">
                Keterangan
            </p>

            <div class="px-3 py-1">
                <div>
                    <p class="text-sm font-semibold">
                        Kehadiran
                    </p>
                </div>
            </div>

            <div class="flex justify-between items-start px-3 py-1 mt-3">
                <div>
                    <p class="text-sm">
                        Hadir
                    </p>
                </div>
                <p class="text-sm text-gray-500 font-semibold">
                    {{ $monthlyRecap->total_attendance }} hari
                </p>
            </div>
            <div class="flex justify-between items-start px-3 py-1">
                <div>
                    <p class="text-sm">
                        Jumlah Telat
                    </p>
                </div>
                <p class="text-sm text-red-500 font-semibold">
                    {{ $monthlyRecap->total_late }} hari
                </p>
            </div>
            <div class="flex justify-between items-start px-3 py-1">
                <div>
                    <p class="text-sm">
                        Cuti/Izin/Sakit
                    </p>
                </div>
                <p class="text-sm text-gray-500 font-semibold">
                    {{ $monthlyRecap->total_permit_leave }} hari
                </p>
            </div>
            <br>
            <br>
            <div class="px-3 py-1">
                <div>
                    <p class="text-sm font-semibold">
                        Reimburse
                    </p>
                </div>
            </div>
            @if ($monthlyRecap->request_reimbursements != null && $monthlyRecap->request_reimbursements->count() > 0)
                <div class="flex justify-between items-start px-3 py-1 mt-3">
                    <div>
                        <p class="text-sm font-medium">
                            Keterangan
                        </p>
                    </div>
                    <p class="text-sm font-medium">
                        Nominal
                    </p>
                    <p class="text-sm font-medium">
                        Status
                    </p>
                </div>
                @foreach ($monthlyRecap->request_reimbursements as $reimbursement)
                    <div class="flex justify-between items-start px-3 py-1">
                        <div>
                            <p class="text-sm">
                                {{ $reimbursement->title }}
                            </p>
                        </div>
                        <p class="text-sm text-gray-500 font-semibold">
                            Rp {{ number_format($reimbursement->nominal, 0, ',', '.') }}
                        </p>
                        <p>
                            {{ $reimbursement->status == 0 ? '<img src="' . asset('assets/icon-button/timer-svgrepo-com.svg') . '" class="w-5 h-5" alt="">' : ($reimbursement->status == 1 ? '<img src="' . asset('assets/icon-button/green-check-circle-svgrepo-com.svg') . '" class="w-5 h-5" alt="">' : '<img src="' . asset('assets/icon-button/red-x-circle-svgrepo-com.svg') . '" class="w-5 h-5" alt="">') }}
                        </p>
                    </div>
                @endforeach
            @else
                <p class="text-sm text-gray-500 px-3 py-1">
                    Tidak ada reimburse
                </p>
            @endif
            <br>
            <br>
            <div class="px-3 py-1">
                <div>
                    <p class="text-sm font-semibold">
                        Penugasan
                    </p>
                </div>
            </div>
            @if ($monthlyRecap->tasks != null && $monthlyRecap->tasks->count() > 0)
                <div class="flex justify-between items-start px-3 py-1 mt-3">
                    <div>
                        <p class="text-sm font-medium">
                            Keterangan
                        </p>
                    </div>
                    <p class="text-sm font-medium">
                        Nominal
                    </p>
                    <p class="text-sm font-medium">
                        Status
                    </p>
                </div>
                @foreach ($monthlyRecap->tasks as $task)
                    <div class="flex justify-between items-start px-3 py-1">
                        <div>
                            <p class="text-sm">
                                {{ $task->title }}
                            </p>
                        </div>
                        <p class="text-sm text-gray-500 font-semibold">
                            Rp {{ number_format($task->total_price, 0, ',', '.') }}
                        </p>
                        <p>
                            {{ $task->status == 0 ? 'Menunggu' : ($task->status == 1 ? 'Diterima' : 'Ditolak') }}
                        </p>
                    </div>
                @endforeach
            @else
                <p class="text-sm text-gray-500 px-3 py-1">
                    Tidak ada penugasan
                </p>
            @endif
        </x-card-container>
    </div>
</x-app-layout>
