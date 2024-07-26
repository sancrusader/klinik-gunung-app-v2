<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'hiker_id',
        'doctor_id',
        'message',
        'status',
    ];

    public function hiker()
    {
        return $this->belongsTo(User::class, 'hiker_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
