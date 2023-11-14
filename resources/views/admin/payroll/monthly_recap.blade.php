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
            <div class="flex justify-between items-start px-3 py-1">
                <div>
                    <p class="text-sm">
                        Lembur
                    </p>
                </div>
                <p class="text-sm text-gray-500 font-semibold">
                    Rp {{ number_format($monthlyRecap->total_overtime, 0, ',', '.') }}
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
                <div class="grid grid-cols-3 text-left px-3 py-2 text-sm font-medium">
                    <div>Keterangan</div>
                    <div>Nominal</div>
                    <div>Status</div>
                </div>
                @foreach ($monthlyRecap->request_reimbursements as $reimbursement)
                    @php
                        $statusIcons = [
                            0 => 'timer-svgrepo-com.svg',
                            1 => 'green-check-circle-svgrepo-com.svg',
                            2 => 'red-x-circle-svgrepo-com.svg',
                        ];
                        $icon = $statusIcons[$reimbursement->status] ?? 'default-icon.svg';
                    @endphp
                    <div class="grid grid-cols-3 text-left px-3 py-2 text-sm">
                        <a class="hover:text-yellow-500"
                            href="{{ route('admin.request-reimbursement.show', $reimbursement->id) }}">
                            ↗
                            {{ $reimbursement->title }}</a>
                        <div class="text-gray-500 font-semibold">Rp
                            {{ number_format($reimbursement->nominal, 0, ',', '.') }}</div>
                        <div><img src="{{ asset('assets/icon-button/' . $icon) }}" class="w-5 h-5" alt="">
                        </div>
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
                <div class="grid grid-cols-3 text-left px-3 py-2 text-sm font-medium">
                    <div>Keterangan</div>
                    <div>Nominal</div>
                    <div>Status</div>
                </div>
                @foreach ($monthlyRecap->tasks as $task)
                    @php
                        $statusIcons = [
                            0 => 'timer-svgrepo-com.svg',
                            1 => 'green-check-circle-svgrepo-com.svg',
                            2 => 'red-x-circle-svgrepo-com.svg',
                        ];
                        $icon = $statusIcons[$task->status] ?? 'default-icon.svg';
                    @endphp
                    <div class="grid grid-cols-3 text-left px-3 py-2 text-sm">
                        <div>{{ $task->title }}</div>
                        <div class="text-gray-500 font-semibold">Rp
                            {{ number_format($task->total_price, 0, ',', '.') }}</div>
                        <div><img src="{{ asset('assets/icon-button/' . $icon) }}" class="w-5 h-5" alt="">
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-sm text-gray-500 px-3 py-1">
                    Tidak ada penugasan
                </p>
            @endif
            <br>
            <br>
            <div class="px-3 py-1">
                <div>
                    <p class="text-sm font-semibold">
                        Lembur
                    </p>
                </div>
            </div>
            @if ($monthlyRecap->overtimes != null && $monthlyRecap->overtimes->count() > 0)
                <div class="grid grid-cols-4 text-left px-3 py-2 text-sm font-medium">
                    <div>Mulai</div>
                    <div>Selesai</div>
                    <div>Durasi</div>
                    <div>Status</div>
                </div>
                @foreach ($monthlyRecap->overtimes as $overtime)
                    @php
                        $statusIcons = [
                            'pending' => 'timer-svgrepo-com.svg',
                            'approved' => 'green-check-circle-svgrepo-com.svg',
                            'rejected' => 'red-x-circle-svgrepo-com.svg',
                        ];
                        $icon = $statusIcons[$overtime->status] ?? 'default-icon.svg';
                    @endphp
                    <div class="grid grid-cols-4 text-left px-3 py-2 text-sm">
                        <div>{{ Carbon\Carbon::parse($overtime->start_at)->format('d M y H:i') }}
                        </div>
                        <div>{{ Carbon\Carbon::parse($overtime->end_at)->format('d M y H:i') }}
                        </div>
                        <div class="text-gray-500 font-semibold">
                            {{ floor($overtime->duration / 60) }} j {{ $overtime->duration % 60 }} m </div>
                        <div><img src="{{ asset('assets/icon-button/' . $icon) }}" class="w-5 h-5" alt="">
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-sm text-gray-500 px-3 py-1">
                    Tidak ada lembur
                </p>
            @endif
        </x-card-container>
    </div>
</x-app-layout>
