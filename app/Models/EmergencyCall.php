<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyCall extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'coordinator_id', 'status'];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function coordinator()
    {
        return $this->belongsTo(User::class, 'coordinator_id');
    }
}
