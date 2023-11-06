<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTracker extends Model
{
    use HasFactory;

    public    $table    = 'time_trackers';
    protected $fillable = [
        'user_id',
        'start_time',
        'end_time',
        'total_time',
        'subject',
        'task',
        'created_by',
        'updated_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
