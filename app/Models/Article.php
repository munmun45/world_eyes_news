<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'slug',
        'summary',
        'content',
        'image',
        'image_caption',
        'views_count',
        'is_breaking',
        'is_featured',
        'is_trending',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
        'tags',
    ];

    protected $casts = [
        'is_breaking' => 'boolean',
        'is_featured' => 'boolean',
        'is_trending' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($article) {
            if (empty($article->slug)) {
                $slug = Str::slug($article->title);
                $originalSlug = $slug;
                $count = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = "{$originalSlug}-{$count}";
                    $count++;
                }
                $article->slug = $slug;
            }
            if (empty($article->published_at) && $article->status === 'published') {
                $article->published_at = now();
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->where('is_approved', true)->latest();
    }

    public function allComments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    // Helper attribute for image URL
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('images/TN-512.png');
        }
        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }
        if (str_starts_with($this->image, 'images/')) {
            return asset($this->image);
        }
        return asset('storage/' . $this->image);
    }

    public function getReadingTimeAttribute()
    {
        $words = str_word_count(strip_tags($this->content));
        $minutes = ceil($words / 200);
        return max(1, $minutes);
    }
}
