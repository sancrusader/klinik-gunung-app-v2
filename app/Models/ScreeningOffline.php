<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScreeningOffline extends Model
{
    use Notifiable;
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
        'amount_paid',
        'age',
        'gender',
        'contact_number',
        'planned_hiking_date',
        'previous_hikes_count'
        
    ];

    public static function generateQueueNumber()
    {
        $lastQueueNumber = self::max('queue_number');
        return $lastQueueNumber ? $lastQueueNumber + 1 : 1;
    }

    public function user()
{
    return $this->belongsTo(User::class, 'user_id'); // Asumsikan ada user_id di ScreeningOffline
}

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
