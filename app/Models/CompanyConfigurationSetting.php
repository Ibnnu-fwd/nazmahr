<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyConfigurationSetting extends Model
{
    use HasFactory;

    public $table = 'company_configuration_settings';
    protected $fillable = [
        'name',
        'address',
        'logo',
        'phone',
        'email',
        'regular_salary',
        'tolerance_late_time_in_minutes',
        'amount_per_day',
        'amount_per_task',
        'amount_per_reimbursement',
        'amount_per_overtime',
        'amount_per_leave',
        'amount_per_absence',
        'amount_per_late',
        'amount_per_early_leave',
    ];
}
