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
        if (empty($this->image)) {
            return asset('images/placeholder.png');
        }

        $imagePath = trim($this->image);

        // Protocol-relative URLs (e.g. //example.com/photo.jpg)
        if (str_starts_with($imagePath, '//')) {
            return (request()->isSecure() ? 'https:' : 'http:') . $imagePath;
        }

        // External full URL
        if (str_starts_with($imagePath, 'http://') || str_starts_with($imagePath, 'https://')) {
            if (request()->isSecure() && str_starts_with($imagePath, 'http://')) {
                return 'https://' . substr($imagePath, 7);
            }
            return $imagePath;
        }

        $cleanPath = ltrim($imagePath, '/\\');

        // Path explicitly starting with 'uploads/' or 'images/'
        if (str_starts_with($cleanPath, 'uploads/') || str_starts_with($cleanPath, 'images/')) {
            return asset($cleanPath);
        }

        // Path explicitly starting with 'storage/'
        if (str_starts_with($cleanPath, 'storage/')) {
            return asset($cleanPath);
        }

        // Check if file exists in public/uploads/
        if (file_exists(public_path('uploads/' . $cleanPath))) {
            return asset('uploads/' . $cleanPath);
        }

        // Check if file exists directly in public/images/
        if (file_exists(public_path('images/' . $cleanPath))) {
            return asset('images/' . $cleanPath);
        }

        // Check if file exists directly in public/
        if (file_exists(public_path($cleanPath))) {
            return asset($cleanPath);
        }

        // Default to storage asset path (e.g. articles/xyz.jpg -> /storage/articles/xyz.jpg)
        return asset('storage/' . $cleanPath);
    }

    public function getReadingTimeAttribute()
    {
        $words = str_word_count(strip_tags($this->content));
        $minutes = ceil($words / 200);
        return max(1, $minutes);
    }
}
