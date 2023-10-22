<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermitLeave extends Model
{
    use HasFactory;

    public $table = 'permit_leaves';

    protected $fillable = [
        'user_id',
        'submission_type',
        'start_date',
        'end_date',
        'attachment',
        'status',
        'created_by',
        'updated_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
