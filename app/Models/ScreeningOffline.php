<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScreeningOffline extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'full_name',
        'queue_number',
        'health_check_result',
        'payment_status',
        'certificate_issued',
        'certificate_path',
        'amount_paid'
    ];
}
