<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PermitLeave extends Model
{

    use Uuids;

    const STATUS_PENDING  = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    const LABEL_PENDING  = 'Menunggu';
    const LABEL_APPROVED = 'Disetujui';
    const LABEL_REJECTED = 'Ditolak';

    use HasFactory;

    public $table = 'permit_leaves';

    protected $fillable = [
        'user_id',
        'submission_type',
        'start_date',
        'end_date',
        'attachment',
        'status',
        'description',
        'created_by',
        'updated_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatus($value)
    {
        if ($value == self::STATUS_PENDING) {
            return self::LABEL_PENDING;
        } elseif ($value == self::STATUS_APPROVED) {
            return self::LABEL_APPROVED;
        } elseif ($value == self::STATUS_REJECTED) {
            return self::LABEL_REJECTED;
        }
    }
}
