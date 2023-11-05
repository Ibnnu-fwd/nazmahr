<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    public $table = 'announcements';

    protected $fillable = [
        'code',
        'subject',
        'content',
        'attachment',
        'is_send_email',
        'is_active'
    ];
}
