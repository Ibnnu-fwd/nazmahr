<x-app-layout>
    <x-breadcrumb name="admin.company-configuration-setting" />

    <div class="max-w-full">
        <form action="{{ route('admin.company-configuration-setting.update') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-card-container>
                <div class="grid grid-cols-4 gap-x-3">
                    <div>
                        <p class="font-semibold text-base">
                            Informasi Umum
                        </p>
                    </div>
                    <div></div>
                    <div class="col-span-2">
                        <x-input id="name" type="text" name="name" label="Nama Perusahaan"
                            value="{{ $setting->name }}" />
                        <x-textarea id="address" name="address" label="Alamat Perusahaan" rows="3"
                            :value="$setting->address" />
                        <x-input id="phone" type="text" name="phone" label="Nomor Telepon"
                            value="{{ $setting->phone }}" />
                        <x-input id="email" type="text" name="email" label="Email"
                            value="{{ $setting->email }}" />
                        <x-input-file id="logo" name="logo" label="Logo Perusahaan" />
                    </div>
                </div>
                <hr class="my-8">
                <div class="grid grid-cols-4 gap-x-3">
                    <div>
                        <p class="font-semibold text-base">
                            Kebijakan Perusahaan
                        </p>
                    </div>
                    <div></div>
                    <div class="col-span-2">
                        <x-input id="regular_salary" type="text" name="regular_salary" label="Gaji Pokok"
                            value="{{ $setting->regular_salary }}" />
                        <x-input id="tolerance_late_time_in_minutes" type="number"
                            name="tolerance_late_time_in_minutes" label="Toleransi Keterlambatan (Menit)"
                            :value="$setting->tolerance_late_time_in_minutes" />
                        <x-input id="amount_per_day" type="text" name="amount_per_day" label="Tunjangan Per Hari"
                            value="{{ $setting->amount_per_day }}" />
                        <x-input id="amount_per_task" type="text" name="amount_per_task" label="Tunjangan Per Tugas"
                            value="{{ $setting->amount_per_task }}" />
                        <x-input id="amount_per_reimbursement" type="text" name="amount_per_reimbursement"
                            label="Tunjangan Per Reimbursement" value="{{ $setting->amount_per_reimbursement }}" />
                        <x-input id="amount_per_overtime" type="text" name="amount_per_overtime"
                            label="Tunjangan Per Jam Lembur" value="{{ $setting->amount_per_overtime }}" />
                        <x-input id="amount_per_leave" type="text" name="amount_per_leave" label="Tunjangan Per Cuti"
                            value="{{ $setting->amount_per_leave }}" />
                        <x-input id="amount_per_absence" type="text" name="amount_per_absence"
                            label="Potongan Per Absen" value="{{ $setting->amount_per_absence }}" />
                        <x-input id="amount_per_late" type="text" name="amount_per_late"
                            label="Potongan Per Keterlambatan" value="{{ $setting->amount_per_late }}" />
                        <x-input id="amount_per_early_leave" type="text" name="amount_per_early_leave"
                            label="Potongan Per Pulang Cepat" value="{{ $setting->amount_per_early_leave }}" />
                    </div>
                    <div></div>
                    <div></div>
                    <div>
                        <br><br>
                        <x-button type="submit" label="Simpan Perubahan" />
                    </div>
                </div>
            </x-card-container>
        </form>
    </div>

    @push('js-internal')
        <script>
            $(function() {
                @if ($setting->logo)
                    $('#logo').parent().append(
                        '<img src="{{ asset('storage/logo/' . $setting->logo) }}" class="mt-4 w-20 h-20 object-cover rounded-full">'
                    );
                @endif

                @include('layouts.alert')

            });
        </script>
    @endpush
</x-app-layout>
