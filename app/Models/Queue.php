<?php

namespace App\Models;

use App\Models\ScreeningOffline;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Queue extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'status',
        'queue_number',
    ];

    public function screenings()
    {
        return $this->hasMany(ScreeningOffline::class);
    }
}
