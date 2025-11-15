<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas';

    protected $fillable = [
        'slug',
        'image',
        'title',
        'description',
        'isi',
        'author',
        'views',
        'date'
    ];

    protected $casts = [
        'date' => 'date',
        'views' => 'integer'
    ];

    // Auto-generate slug dari title
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            if (empty($berita->slug)) {
                $berita->slug = $berita->generateUniqueSlug($berita->title);
            }
        });

        static::updating(function ($berita) {
            if ($berita->isDirty('title') && empty($berita->slug)) {
                $berita->slug = $berita->generateUniqueSlug($berita->title, $berita->id);
            }
        });
    }

    // Generate unique slug
    public function generateUniqueSlug($title, $id = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while ($this->slugExists($slug, $id)) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    // Check if slug exists
    protected function slugExists($slug, $id = null)
    {
        $query = static::where('slug', $slug);
        
        if ($id) {
            $query->where('id', '!=', $id);
        }

        return $query->exists();
    }

    // Increment views counter
    public function incrementViews()
    {
        $this->increment('views');
        $this->views += 1;
    }

    // Scope untuk berita terbaru
    public function scopeLatest($query)
    {
        return $query->orderBy('date', 'desc')->orderBy('created_at', 'desc');
    }

    // Scope untuk berita populer
    public function scopePopular($query, $limit = 5)
    {
        return $query->orderBy('views', 'desc')->limit($limit);
    }
}
