<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    const STATUS_PENDING   = '0';
    const STATUS_APPROVED = '1';
    const STATUS_REJECTED  = '2';

    const LABEL_PENDING  = 'Menunggu';
    const LABEL_APPROVED = 'Disetujui';
    const LABEL_REJECTED = 'Ditolak';


    use HasFactory;

    public $table = 'overtimes';

    protected $fillable = [
        'user_id',
        'duration',
        'attachment',
        'status',
        'start_at',
        'end_at',
        'created_by',
        'updated_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatus($value)
    {
        switch ($value) {
            case self::STATUS_PENDING:
                return self::LABEL_PENDING;
                break;
            case self::STATUS_APPROVED:
                return self::LABEL_APPROVED;
                break;
            case self::STATUS_REJECTED:
                return self::LABEL_REJECTED;
                break;
            default:
                return self::LABEL_PENDING;
                break;
        }
    }
}
