<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 "
    aria-label="Sidebar">

    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        @if (auth()->user()->position->name == 'Admin')
            <ul class="space-y-2 font-medium text-sm">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg  group {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100' : '' }}">
                        <img src="{{ asset('assets/sidebar/dashboard.svg') }}"
                            class="w-5 h-5 text-gray-500 transition duration-75" alt="">
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                        aria-controls="master-information" data-collapse-toggle="master-information">
                        <img src="{{ asset('assets/sidebar/master.svg') }}"
                            class="w-5 h-5 text-gray-500 transition duration-75" alt="">
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Master Informasi</span>
                        <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="master-information"
                        class="py-2 space-y-2 {{ request()->routeIs('admin.announcement.index') || request()->routeIs('admin.reprimand.*') ? '' : 'hidden' }}">
                        <li>
                            <a href="{{ route('admin.announcement.index') }}"
                                class="flex items-center p-2 text-gray-900 rounded-lg pl-10 group {{ request()->routeIs('admin.announcement.*') ? 'bg-gray-100' : '' }}">
                                <span class="">Pengumuman</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.reprimand.index') }}"
                                class="flex items-center p-2 text-gray-900 rounded-lg pl-10 group {{ request()->routeIs('admin.reprimand.*') ? 'bg-gray-100' : '' }}">
                                <span class="">Peringatan</span>
                            </a>
                        </li>
                    </ul>
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
                    <ul id="master-data"
                        class="{{ request()->routeIs('admin.position.index') || request()->routeIs('admin.casbon.index') || request()->routeIs('admin.employee.*') ? '' : 'hidden' }} py-2 space-y-2">
                        <li>
                            <a href="{{ route('admin.position.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-10 group {{ request()->routeIs('admin.position.*') ? 'bg-gray-100' : '' }} hover:bg-gray-100">Jabatan</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.casbon.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-10 group {{ request()->routeIs('admin.casbon.*') ? 'bg-gray-100' : '' }} hover:bg-gray-100">Kasbon</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.employee.index') }}"
                                class="flex
                            items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-10 group {{ request()->routeIs('admin.employee.*') ? 'bg-gray-100' : '' }}
                            hover:bg-gray-100">Karyawan</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                        aria-controls="master-absensi" data-collapse-toggle="master-absensi">
                        <img src="{{ asset('assets/sidebar/master.svg') }}"
                            class="w-5 h-5 text-gray-500 transition duration-75" alt="">
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Master Absensi</span>
                        <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="master-absensi" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('admin.attendance-time-config.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-10 group hover:bg-gray-100">Jam
                                Kerja</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.attendance-type.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-10 group hover:bg-gray-100">Tipe</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.overtime.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-10 group hover:bg-gray-100">Lembur</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.time-tracker.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-10 group hover:bg-gray-100">Timesheet</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.attendance.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-10 group hover:bg-gray-100">Presensi</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                        aria-controls="master-task" data-collapse-toggle="master-task">
                        <img src="{{ asset('assets/sidebar/master.svg') }}"
                            class="w-5 h-5 text-gray-500 transition duration-75" alt="">
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Master Tugas</span>
                        <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="master-task" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('admin.task-type.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-10 group hover:bg-gray-100">Jenis</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.task.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-10 group hover:bg-gray-100">Daftar</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                        aria-controls="master-request" data-collapse-toggle="master-request">
                        <img src="{{ asset('assets/sidebar/master.svg') }}"
                            class="w-5 h-5 text-gray-500 transition duration-75" alt="">
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Master Permintaan</span>
                        <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="master-request" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('admin.request-attendance.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-10 group hover:bg-gray-100">Absensi</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.request-reimbursement.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-10 group hover:bg-gray-100">Reimbursement</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.permit-leave.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-10 group hover:bg-gray-100">Izin/Cuti</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                        aria-controls="master-setting" data-collapse-toggle="master-setting">
                        <img src="{{ asset('assets/sidebar/master.svg') }}"
                            class="w-5 h-5 text-gray-500 transition duration-75" alt="">
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Master Pengaturan</span>
                        <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="master-setting"
                        class="py-2 space-y-2 {{ request()->routeIs('admin.payroll.*') || request()->routeIs('admin.profile.*') || request()->routeIs('admin.company-configuration-setting.*') ? '' : 'hidden' }}">
                        <li>
                            <a href="{{ route('admin.company-configuration-setting.index') }}"
                                class="flex items-center p-2 text-gray-900 rounded-lg pl-10 group {{ request()->routeIs('admin.company-configuration-setting.*') ? 'bg-gray-100' : '' }}">
                                <span class="">Perusahaan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.payroll.index') }}"
                                class="flex items-center p-2 text-gray-900 rounded-lg pl-10 group {{ request()->routeIs('admin.payroll.*') ? 'bg-gray-100' : '' }}">
                                <span class="">Payroll</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.profile.index') }}"
                                class="flex items-center p-2 text-gray-900 rounded-lg pl-10 group {{ request()->routeIs('admin.profile.*') ? 'bg-gray-100' : '' }}">
                                <span class="">Profil</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="flex items-center p-2 text-gray-900 rounded-lg group">
                            <img src="{{ asset('assets/sidebar/logout-svgrepo-com.svg') }}"
                                class="w-5 h-5 text-gray-500 transition duration-75" alt="">
                            <span class="flex-1 ml-3 whitespace-nowrap">Keluar</span>
                        </a>
                    </form>
                </li>

            </ul>
        @endif


        @if (auth()->user()->position_id != 1)
            <ul class="space-y-2 font-medium text-sm">
                <li>
                    <a href="{{ route('user.dashboard.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg group {{ request()->routeIs('user.dashboard.*') ? 'bg-gray-100' : '' }}">
                        <img src="{{ asset('assets/sidebar/dashboard.svg') }}"
                            class="w-5 h-5 text-gray-500 transition duration-75" alt="">
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>

                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                        aria-controls="master-absensi" data-collapse-toggle="master-absensi">
                        <img src="{{ asset('assets/sidebar/master.svg') }}"
                            class="w-5 h-5 text-gray-500 transition duration-75" alt="">
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Master Absensi</span>
                        <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="master-absensi"
                        class="py-2 space-y-2 {{ request()->routeIs('user.attendance.*') || request()->routeIs('user.overtime.*') ? '' : 'hidden' }}">
                        <li>
                            <a href="{{ route('user.attendance.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-10 group {{ request()->routeIs('user.attendance.*') ? 'bg-gray-100' : '' }} hover:bg-gray-100">Presensi</a>
                        </li>
                        <li>
                            <a href="{{ route('user.overtime.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-10 group {{ request()->routeIs('user.overtime.*') ? 'bg-gray-100' : '' }} hover:bg-gray-100">Lembur</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                        aria-controls="master-task" data-collapse-toggle="master-task">
                        <img src="{{ asset('assets/sidebar/master.svg') }}"
                            class="w-5 h-5 text-gray-500 transition duration-75" alt="">
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Master Tugas</span>
                        <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="master-task"
                        class="py-2 space-y-2 {{ request()->routeIs('user.task.*') ? '' : 'hidden' }}">
                        <li>
                            <a href="{{ route('user.task.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-10 group {{ request()->routeIs('user.task.*') ? 'bg-gray-100' : '' }} hover:bg-gray-100">Daftar</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                        aria-controls="master-request" data-collapse-toggle="master-request">
                        <img src="{{ asset('assets/sidebar/master.svg') }}"
                            class="w-5 h-5 text-gray-500 transition duration-75" alt="">
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Master Permintaan</span>
                        <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="master-request"
                        class="py-2 space-y-2 {{ request()->routeIs('user.request-attendance.*') || request()->routeIs('user.request-reimbursement.*') || request()->routeIs('user.permit-leave.*') ? '' : 'hidden' }}">
                        <li>
                            <a href="{{ route('user.request-attendance.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-10 group {{ request()->routeIs('user.request-attendance.*') ? 'bg-gray-100' : '' }} hover:bg-gray-100">Absensi</a>
                        </li>
                        <li>
                            <a href="{{ route('user.request-reimbursement.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-10 group {{ request()->routeIs('user.request-reimbursement.*') ? 'bg-gray-100' : '' }} hover:bg-gray-100">Reimbursement</a>
                        </li>
                        <li>
                            <a href="{{ route('user.permit-leave.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-10 group {{ request()->routeIs('user.permit-leave.*') ? 'bg-gray-100' : '' }} hover:bg-gray-100">Izin/Cuti</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                        aria-controls="master-setting" data-collapse-toggle="master-setting">
                        <img src="{{ asset('assets/sidebar/master.svg') }}"
                            class="w-5 h-5 text-gray-500 transition duration-75" alt="">
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Master Pengaturan</span>
                        <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="master-setting"
                        class="py-2 space-y-2 {{ request()->routeIs('user.payroll.*') || request()->routeIs('user.profile.*') ? '' : 'hidden' }}">
                        <li>
                            <a href="{{ route('user.payroll.index') }}"
                                class="flex items-center p-2 text-gray-900 rounded-lg pl-10 group {{ request()->routeIs('user.payroll.*') ? 'bg-gray-100' : '' }} hover:bg-gray-100">
                                <span class="">Payroll</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.profile.index') }}"
                                class="flex items-center p-2 text-gray-900 rounded-lg pl-10 group {{ request()->routeIs('user.profile.*') ? 'bg-gray-100' : '' }} hover:bg-gray-100">
                                <span class="">Profil</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="flex items-center p-2 text-gray-900 rounded-lg group">
                            <img src="{{ asset('assets/sidebar/logout-svgrepo-com.svg') }}"
                                class="w-5 h-5 text-gray-500 transition duration-75" alt="">
                            <span class="flex-1 ml-3 whitespace-nowrap">Keluar</span>
                        </a>
                    </form>
                </li>

            </ul>
        @endif
    </div>
</aside>
