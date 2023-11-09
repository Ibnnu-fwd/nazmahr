<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory, Uuids;

    public $table = 'tasks';

    protected $fillable = [
        'task_type_id',
        'title',
        'user_id',
        'due_date',
        'description',
        'status',
        'price',
        'created_by',
        'updated_by',
    ];

    public function task_type()
    {
        return $this->belongsTo(TaskType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
