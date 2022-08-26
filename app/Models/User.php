<?php

namespace App\Models;

use App\Models\FilamentBlog\Post;
use App\Models\Videos\Video;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use Impersonate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'last_seen_at',
        'active_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'last_seen_at' => 'timestamp',
        'active_status' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [];

    /**
     * @return bool
     */
    public function canImpersonate()
    {
        // For example
        return auth()->user()->hasRole('super_admin');
    }

    /**
     * @return bool
     */
    public function canBeImpersonated()
    {
        // For example
        return auth()->user()->hasAnyRole(['normal_user']);
    }

    public function watchedLaterVideos()
    {
        return $this->belongsToMany(Video::class, (new WatchedLaterVideo)->getTable(), 'user_id', 'video_id');
    }

    public function watchedLaterPosts()
    {
        return $this->belongsToMany(Post::class, (new WatchedLaterPost())->getTable(), 'user_id', 'post_id');
    }
}
