<?php

namespace App\Repositories;

use App\Interfaces\CompanyConfigurationSettingInterface;
use App\Models\CompanyConfigurationSetting;
use Illuminate\Support\Facades\Storage;

class CompanyConfigurationSettingRepository implements CompanyConfigurationSettingInterface
{
    private $companyConfigurationSetting;

    public function __construct(CompanyConfigurationSetting $companyConfigurationSetting)
    {
        $this->companyConfigurationSetting = $companyConfigurationSetting;
    }

    public function getSetting()
    {
        $result = $this->companyConfigurationSetting->first();
        if ($result == null) {
            $result = $this->companyConfigurationSetting->create([
                'name'                           => 'Company Name',
                'address'                        => 'Company Address',
                'logo'                           => null,
                'phone'                          => null,
                'email'                          => null,
                'regular_salary'                 => 0,
                'tolerance_late_time_in_minutes' => 0,
                'amount_per_day'                 => 0,
                'amount_per_task'                => 0,
                'amount_per_reimbursement'       => 0,
                'amount_per_overtime'            => 0,
                'amount_per_leave'               => 0,
            ]);
        }

        return $result;
    }

    public function update($data)
    {
        $setting = $this->companyConfigurationSetting->first();
        if (isset($data['logo'])) {
            $filename = uniqid() . '.' . $data['logo']->extension();
            $data['logo']->storeAs('public/logo', $filename);
            $data['logo'] = $filename;

            if ($setting->logo != null) {
                Storage::delete('public/logo/' . $setting->logo);
            }
        }

        $setting->update($data);
        return $setting;
    }
}
