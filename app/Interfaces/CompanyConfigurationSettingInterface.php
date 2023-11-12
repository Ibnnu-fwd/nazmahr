<?php

namespace App\Interfaces;

interface CompanyConfigurationSettingInterface
{
    public function getSetting();
    public function update($data);
}
