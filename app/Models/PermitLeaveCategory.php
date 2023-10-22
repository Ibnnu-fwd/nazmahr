<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermitLeaveCategory extends Model
{
    use HasFactory;

    public $table = 'permit_leaves_categories';

    protected $fillable = [
        'name',
        'status'
    ];
}
