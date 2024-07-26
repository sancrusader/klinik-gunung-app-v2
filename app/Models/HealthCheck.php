<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'scan_id',
        'full_name',
        'date_of_birth',
        'mountain',
        'citizenship',
        'country',
        'address',
        'phone',
        'email',
        'question_1',
        'question_2',
        'payment_done',
    ];

    // Relasi banyak ke satu dengan Scan
    public function scan()
    {
        return $this->belongsTo(Scan::class);
    }
}
