<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CompanyConfigurationSettingInterface;
use Illuminate\Http\Request;

class CompanyConfigurationSettingController extends Controller
{
    private $setting;

    public function __construct(CompanyConfigurationSettingInterface $setting)
    {
        $this->setting = $setting;
    }

    public function index()
    {
        return view('admin.company_configuration_setting.index', [
            'setting' => $this->setting->getSetting(),
        ]);
    }

    public function update(Request $request)
    {
        $this->setting->update($request->all());
        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui');
    }
}
