<?php

namespace App\Models\Videos;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Tags\HasTags;

class Video extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTags;

    protected $guarded = [];

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
        return $this->belongsTo(User::class);
    }
}
