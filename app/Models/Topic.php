<?php

namespace App\Models;

use Conner\Likeable\Likeable;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Topic extends Model
{
    use HasFactory, Likeable;

    protected $fillable = ['title', 'description', 'user_id', 'image_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->setTimezone('Asia/Jakarta')->format('d/m/Y h:i A');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
        public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function isTopicCreator(Topic $topic)
{
    return $this->id === $topic->user_id;
}

}

