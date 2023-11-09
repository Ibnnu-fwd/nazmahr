<x-app-layout>
    @section('title', 'Karyawan')

    <x-breadcrumb name="admin.attendance.live" />

    <x-card-container class="max-w-xl mx-auto">
        <div class="text-center">
            <p><span id="current-time" class="font-semibold text-lg"></span>&nbsp;&nbsp;WIB</p>
            <p id="current-date" class="text-gray-400 font-medium"></p>
        </div>
        <hr class="my-4">
        <div class="mt-4">
            <p id="current-location" class="text-gray-400 font-medium"></p>
            <p class="text-gray-400 font-medium mt-2">
                Coordinate : <span id="current-latitude"></span> | <span id="current-longitude"></span>
            </p>
        </div>
        <hr class="my-4">
        <div class="text-center">
            <p class="text-gray-400 font-medium">Terjadwal, {{ now()->locale('id')->isoFormat('LL') }}.</p>
            <p class="font-semibold text-lg uppercase">
                {{ $attendanceTimeConfig->attendanceType->name }}
            </p>
            <p class="font-semibold text-lg">
                {{ Carbon\Carbon::parse($attendanceTimeConfig->start_time)->format('H:i') }} -
                {{ Carbon\Carbon::parse($attendanceTimeConfig->end_time)->format('H:i') }} WIB
            </p>
        </div>
        <div class="flex items-center gap-x-2 justify-center mt-5">
            @if ($attendance == null || $attendance->entry_at === null)
                <button type="button" onclick="clockIn()"
                    class="text-white bg-[#24292F] hover:bg-[#24292F]/90 focus:ring-4 focus:outline-none focus:ring-[#24292F]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-500 dark:hover:bg-[#050708]/30 mr-2 mb-2">
                    Absensi Masuk
                </button>
            @endif
        </div>

        @if ($attendance != null && $attendance->entry_at !== null && $attendance->exit_at === null)
            <x-textarea name="description" id="description" label="Catatan" required />
            <div class="flex justify-center mt-5">
                <button type="button" onclick="clockOut()"
                    class="text-white bg-[#24292F] hover:bg-[#24292F]/90 focus:ring-4 focus:outline-none focus:ring-[#24292F]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-500 dark:hover:bg-[#050708]/30 mr-2 mb-2">
                    Absensi Keluar
                </button>
            </div>
        @endif

        @if ($attendance != null)
            <hr class="my-2">
            <div class="flex justify-between gap-x-6 mt-5">
                <div>
                    <p class="font-semibold">Tanggal</p>
                    <p class="">
                        {{ Carbon\Carbon::parse($attendance->entry_at)->format('d F Y') }}
                    </p>
                </div>
                <div>
                    <p class="font-semibold">Absensi Masuk</p>
                    <p class="">
                        {{ $attendance->entry_at ? Carbon\Carbon::parse($attendance->entry_at)->format('H:i') . ' WIB' : '-' }}
                </div>
                <div>
                    <p class="font-semibold">Absensi Keluar</p>
                    <p class="">
                        {{ $attendance->exit_at ? Carbon\Carbon::parse($attendance->exit_at)->format('H:i') . ' WIB' : '-' }}
                </div>
            </div>
            <div class="mt-4">
                <p class="font-semibold">Catatan</p>
                <p>
                    {{ $attendance->description ?? '-' }}
                </p>
            </div>
        @endif
    </x-card-container>


    @push('js-internal')
        <script>
            navigator.geolocation.getCurrentPosition((position) => {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                $('#current-latitude').text(latitude);
                $('#current-longitude').text(longitude);
                const url =
                    `https://api.opencagedata.com/geocode/v1/json?key=51453d712e9f429197b169309e4aae1e&q=${latitude}+${longitude}&pretty=1&no_annotations=1`;
                fetch(url)
                    .then((resp) => resp.json())
                    .then(function(data) {
                        const location = data.results[0].formatted;
                        $('#current-location').text(location);
                    })
                    .catch(function() {
                        // This is where you run code if the server returns any errors
                    });
            });

            function clockIn() {
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.attendance.clock-in') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        location: $('#current-location').text(),
                        latitude: $('#current-latitude').text(),
                        longitude: $('#current-longitude').text(),
                    },
                    success: function(response) {
                        if (response.status == true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                                showConfirmButton: false
                            }).then((result) => {
                                window.location.reload();
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message,
                                showConfirmButton: false,
                            }).then((result) => {
                                window.location.reload();
                            })
                        }
                    }
                });
            }

            function clockOut() {
                let description = $('#description').val();
                if (description == '' || description == null || description == undefined) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Catatan tidak boleh kosong',
                        showConfirmButton: false,
                    });
                    return;
                }
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.attendance.clock-out') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        description: description,
                        location: $('#current-location').text(),
                        latitude: $('#current-latitude').text(),
                        longitude: $('#current-longitude').text(),
                    },
                    success: function(response) {
                        if (response.status == true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                                showConfirmButton: false,
                            }).then((result) => {
                                window.location.reload();
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message,
                                showConfirmButton: false,
                            });
                        }
                    }
                });
            }

            $(function() {
                function updateTime() {
                    const now = new Date();
                    const hours = now.getHours();
                    const minutes = now.getMinutes();
                    const seconds = now.getSeconds();
                    const day = now.toLocaleDateString('id-ID', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                    });

                    $('#current-time').text(
                        `${hours < 10 ? '0' + hours : hours}:${
                            minutes < 10 ? '0' + minutes : minutes
                        }`
                    );
                    $('#current-date').text(day);
                }

                updateTime();
                setInterval(updateTime, 1000);
            });
        </script>
    @endpush
</x-app-layout>
