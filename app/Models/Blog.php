<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'tags',
        'author_name',
        'author_profile_picture',
    ];

    /**
     * Set the tags attribute to always be lowercase and trimmed.
     *
     * @param string $value
     * @return void
     */
    public function setTagsAttribute($value)
    {
        $this->attributes['tags'] = strtolower(trim($value));
    }

    /**
     * Get the tags attribute and convert it into an array.
     *
     * @return array
     */
    public function getTagsAttribute()
    {
        return explode(',', $this->attributes['tags']);
    }

    /**
     * Accessor for formatted creation date.
     *
     * @return string
     */
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
