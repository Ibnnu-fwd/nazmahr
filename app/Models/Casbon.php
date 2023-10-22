<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Casbon extends Model
{
    use HasFactory;

    public $table = 'casbons';

    protected $fillable = [
        'user_id',
        'date',
        'nominal',
        'status',
        'refund_attachment',
        'application_attachment',
        'created_by',
        'updated_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
