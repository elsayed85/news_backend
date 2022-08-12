<?php

namespace App\Models\Videos;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Tags\HasTags;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class Video extends Model implements HasMedia, Viewable
{
    use HasFactory;
    use SoftDeletes;
    use HasTags;
    use InteractsWithMedia, InteractsWithViews;

    protected $guarded = [];

    protected $dates = ['deleted_at', 'published_at'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::creating(function ($query) {
            $query->user_id = auth()->id();
        });

        static::updating(function ($query) {
            $query->user_id = auth()->id();
        });
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'video_categories', 'video_id', 'category_id');
    }

    public function scopePublished(Builder $query)
    {
        return $query->whereNotNull('published_at')->whereNull('deleted_at');
    }

    public function scopeDraft(Builder $query)
    {
        return $query->whereNull('published_at');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('videos');
    }
}
