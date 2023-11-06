<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'birth',
        'gender',
        'phone',
        'address',
        'ktp',
        'photo',
        'join_date',
        'is_active',
        'position_id',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function casbons()
    {
        return $this->hasMany(Casbon::class);
    }

    public function overtimes()
    {
        return $this->hasMany(Overtime::class);
    }

    public function permit_leaves()
    {
        return $this->hasMany(PermitLeave::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function attendance_time_configs()
    {
        return $this->hasMany(AttendanceTimeConfig::class);
    }

    public function position()
    {
        return $this->belongsTo(Positition::class);
    }

    public function reprimands()
    {
        return $this->hasMany(Reprimand::class);
    }
}
