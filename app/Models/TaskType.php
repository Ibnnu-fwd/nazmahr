<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskType extends Model
{
    use HasFactory;

    public $table = 'task_types';

    protected $fillable = [
        'name',
        'status',
        'priority',
        'created_by',
        'updated_by'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
