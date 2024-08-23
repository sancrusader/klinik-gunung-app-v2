<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KtpScan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'nik', 'address', 'image_path'];
}
