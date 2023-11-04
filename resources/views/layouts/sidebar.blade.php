<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 "
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium text-sm">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg  group">
                    <img src="{{ asset('assets/sidebar/dashboard.svg') }}"
                        class="w-5 h-5 text-gray-500 transition duration-75" alt="">
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg  group">
                    <img src="{{ asset('assets/sidebar/announcment.svg') }}"
                        class="w-5 h-5 text-gray-500 transition duration-75" alt="">
                    <span class="flex-1 ml-3 whitespace-nowrap">Pengumuman</span>
                </a>
            </li>
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                    aria-controls="master-data" data-collapse-toggle="master-data">
                    <img src="{{ asset('assets/sidebar/master.svg') }}"
                        class="w-5 h-5 text-gray-500 transition duration-75" alt="">
                    <span class="flex-1 ml-3 text-left whitespace-nowrap">Master Data</span>
                    <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="master-data" class="hidden py-2 space-y-2">
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Jam
                            Kerja</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.position.index') }}"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Jabatan</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Izin/Cuti</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Lembur</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Kasbon</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Karyawan</a>
                    </li>
                </ul>
            </li>
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                    aria-controls="master-task" data-collapse-toggle="master-task">
                    <img src="{{ asset('assets/sidebar/inbox-svgrepo-com.svg') }}"
                        class="w-5 h-5 text-gray-500 transition duration-75" alt="">
                    <span class="flex-1 ml-3 text-left whitespace-nowrap">Master Tugas</span>
                    <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="master-task" class="hidden py-2 space-y-2">
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Jenis</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Daftar</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg  group">
                    <img src="{{ asset('assets/sidebar/alarm-svgrepo-com.svg') }}"
                        class="w-5 h-5 text-gray-500 transition duration-75" alt="">
                    <span class="flex-1 ml-3 whitespace-nowrap">Presensi</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg  group">
                    <img src="{{ asset('assets/sidebar/license-svgrepo-com.svg') }}"
                        class="w-5 h-5 text-gray-500 transition duration-75" alt="">
                    <span class="flex-1 ml-3 whitespace-nowrap">Payroll</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                        class="flex items-center p-2 text-gray-900 rounded-lg group">
                        <img src="{{ asset('assets/sidebar/logout-svgrepo-com.svg') }}"
                            class="w-5 h-5 text-gray-500 transition duration-75" alt="">
                        <span class="flex-1 ml-3 whitespace-nowrap">Keluar</span>
                    </a>
                </form>
            </li>

        </ul>
    </div>
</aside>
