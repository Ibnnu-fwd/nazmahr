<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskType extends Model
{
    use HasFactory;

    public $table = 'task_types';

    protected $fillable = [
        'task_type_id',
        'user_id',
        'due_date',
        'description',
        'status',
        'created_by',
        'updated_by'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
