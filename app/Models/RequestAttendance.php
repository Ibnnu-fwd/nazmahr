<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestAttendance extends Model
{

    const STATUS_PENDING = 'Pending';   
    const STATUS_CONFIRMED = 'Confirmed';
    const STATUS_REJECTED  = 'Rejected';

    use HasFactory;

    public $table = 'request_attendances';

    protected $fillable = [
        'attendance_type_id',        
        'user_id',
        'entry_at',
        'exit_at',
        'description',
        'status_verification',
        'status',
        'created_by',
        'updated_by'
    ];

    public function attendanceType()
    {
        return $this->belongsTo(AttendanceType::class);
    }

    public function attendanceTimeConfig()
    {
        return $this->belongsTo(AttendanceTimeConfig::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}