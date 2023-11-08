<x-app-layout>
    @section('title', 'Dashboard')

    <x-breadcrumb name="admin.dashboard" />

    <x-card-container>
        <p class="text-lg font-bold">
            Selamat
            {{ date('H') >= 12 ? 'siang' : (date('H') >= 18 ? 'malam' : 'pagi') }},
            {{ auth()->user()->name }}!
        </p>
        <p class="text-gray-400">
            Ini adalah hari {{ now()->locale('id')->isoFormat('dddd') }},
            {{ now()->locale('id')->isoFormat('LL') }}.
        </p>

        <p class="font-semibold mt-5">
            Shortcut
        </p>

        <div class="flex gap-x-3 mt-4">
            <a href="{{ route('admin.attendance.live') }}"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-semibold rounded-full text-sm px-5 py-2.5 mr-2 mb-2 ">
                Absensi langsung
            </a>
            <a href="{{ route('admin.request-reimbursement.index') }}"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-semibold rounded-full text-sm px-5 py-2.5 mr-2 mb-2 ">
                Request reimbursement
            </a>
            <a href="{{ route('admin.permit-leave.index') }}"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-semibold rounded-full text-sm px-5 py-2.5 mr-2 mb-2 ">
                Request cuti/izin
            </a>
            <a href="{{ route('admin.overtime.index') }}"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-semibold rounded-full text-sm px-5 py-2.5 mr-2 mb-2 ">
                Request lembur
            </a>
            <a href="{{ route('admin.request-attendance.index') }}"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-semibold rounded-full text-sm px-5 py-2.5 mr-2 mb-2 ">
                Request absensi
            </a>

        </div>
    </x-card-container>
</x-app-layout>
