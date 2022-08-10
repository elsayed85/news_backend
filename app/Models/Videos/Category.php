<?php

namespace App\Models\Videos;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'vid_categories';

    protected $guarded = [];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public function videos()
    {
        return $this->belongsToMany(Video::class, 'video_categories', 'video_id', 'category_id');
    }

    public function scopeIsVisible(Builder $query)
    {
        return $query->whereIsVisible(true);
    }

    public function scopeIsInvisible(Builder $query)
    {
        return $query->whereIsVisible(false);
    }
}
