<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'date_of_birth',
        'mountain',
        'citizenship',
        'country',
        'address',
        'phone',
        'email',
        'question1',
        'question2',
        'question3',
        'additional_notes',
        'status',
        'queue_number',
        'payment_status',
        'payment_confirmed',
        'certificate_path',
        'certificate_issued',
        'qr_code_url',
    ];
}
