<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reprimand extends Model
{
    const REPRIMAND_TYPES = ['SP1', 'SP2', 'SP3'];

    use HasFactory;

    public $table = 'reprimands';

    protected $fillable = [
        'user_id',
        'reprimand_type',
        'start_date',
        'end_date',
        'content',
        'attachment',
        'is_send_email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
