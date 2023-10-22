<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Positition extends Model
{
    use HasFactory;

    public $table = 'positions';

    protected $fillable = [
        'name',
        'status',
        'created_by',
        'updated_by'
    ];
}
