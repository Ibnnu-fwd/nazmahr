<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceType extends Model
{
    use HasFactory;

    public $table = 'attendance_types';

    protected $fillable = [
        'name',
        'status',
        'created_by',
        'updated_by'
    ];

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
}
