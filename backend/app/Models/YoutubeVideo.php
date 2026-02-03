<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class YoutubeVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'youtube_id',
        'thumbnail_url',
        'category',
        'duration',
        'views',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function getEmbedUrlAttribute()
    {
        return "https://www.youtube.com/embed/{$this->youtube_id}";
    }

    public function getWatchUrlAttribute()
    {
        return "https://www.youtube.com/watch?v={$this->youtube_id}";
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
