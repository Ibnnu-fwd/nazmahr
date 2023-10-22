<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    public $table = 'attendances';

    protected $fillable = [
        'attendance_type_id',
        'user_id',
        'entry_at',
        'description',
        'status',
        'created_by',
        'updated_by'
    ];

    public function attendanceType()
    {
        return $this->belongsTo(AttendanceType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
