<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    const AMOUNT_PER_DAY = 100000;

    use HasFactory;

    public $table = 'payrolls';

    protected $fillable = [
        'user_id',
        'salary',
        'total_reimbursement',
        'total_task',
        'total_payroll',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
