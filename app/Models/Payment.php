<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'queue_id',
        'status',
    ];

    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }
}
