<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTracker extends Model
{

    const STATUS = [
        0 => 'Belum Selesai',
        1 => 'Selesai'
    ];

    use HasFactory;

    public    $table    = 'time_trackers';
    protected $fillable = [
        'user_id',
        'start_time',
        'end_time',
        'total_time',
        'status',
        'subject',
        'task',
        'created_by',
        'updated_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatus($value)
    {
        return self::STATUS[$value];
    }
}
