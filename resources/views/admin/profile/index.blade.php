<x-app-layout>
    @section('title', 'Profile')

    {{-- <x-breadcrumb name="admin.dashboard" /> --}}

    <div class="max-w-md mx-auto">
        <x-card-container>
            <div class="md:flex w-full">
                <div class="mr-8 mb-8 flex justify-center">
                    <img class="object-cover aspect-square w-28 h-28 rounded-full"
                        src="{{ asset('storage/photo/' . $user->photo) }}" alt="">
                </div>

                <div class="space-y-2 col-span-5 justify-start items-center">
                    <h3 class="text-lg font-bold leading-6 text-black">
                        {{ $user->name }}
                    </h3>
                    <p class="text-base text-gray-500">
                        {{ $user->position->name }}
                    </p>
                    <div class="flex items-center">
                        <img src="{{ asset('assets/profile/email.svg') }}"
                            class="w-5 h-5 text-gray-500 transition duration-75 mr-2" alt="">
                        <p class="text-base text-gray-500">
                            {{ $user->email }}
                        </p>
                    </div>
                    <div class="flex items-center">
                        <img src="{{ asset('assets/profile/calendar.svg') }}"
                            class="w-5 h-5 text-gray-500 transition duration-75 mr-2" alt="">
                        <p class="text-base text-gray-500">
                            {{ Carbon\Carbon::parse($user->birth_date)->translatedFormat('d F Y') }}
                        </p>
                    </div>
                    <div class="flex items-center">
                        <img src="{{ asset('assets/profile/gender.svg') }}"
                            class="w-5 h-5 text-gray-500 transition duration-75 mr-2" alt="">
                        <p class="text-base text-gray-500">
                            {{ $user->gender == 'L' ? 'Laki-Laki' : 'Perempuan' }}
                        </p>
                    </div>
                    <div class="flex items-center">
                        <img src="{{ asset('assets/profile/map.svg') }}"
                            class="w-5 h-5 text-gray-500 transition duration-75 mr-2" alt="">
                        <p class="text-base text-gray-500">
                            {{ $user->phone }}
                        </p>
                    </div>
                    <div class="flex items-center">
                        <img src="{{ asset('assets/profile/phone.svg') }}"
                            class="w-5 h-5 text-gray-500 transition duration-75 mr-2" alt="">
                        <p class="text-base text-gray-500">
                            {{ $user->address }}
                        </p>
                    </div>

                </div>
        </x-card-container>
    </div>
</x-app-layout>
