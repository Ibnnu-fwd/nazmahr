<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestReimbursement extends Model
{
    const STATUS_PENDING   = '0';
    const STATUS_APPROVED = '1';
    const STATUS_REJECTED  = '2';

    const LABEL_PENDING   = 'Menunggu';
    const LABEL_APPROVED = 'Disetujui';
    const LABEL_REJECTED  = 'Ditolak';

    use HasFactory;

    public $table = 'request_reimbursement';

    protected $fillable = [
        'user_id',
        'title',
        'date',
        'description',
        'nominal',
        'status',
        'bill_attachment',
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