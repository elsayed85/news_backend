<?php

namespace App\Observers\Blog;

use App\Events\Blog\Post\PostPublished;
use App\Models\FilamentBlog\Post;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class PostObserver
{

    public function creating(Post $post)
    {
        if($post->isPublished()) {
            event(new PostPublished($post));
        }
    }


    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\FilamentBlog\Post  $post
     * @return void
     */
    public function created(Post $post)
    {

    }

    /**
     * Handle the Post "updated" event.
     *
     * @param  \App\Models\FilamentBlog\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {

    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param  \App\Models\FilamentBlog\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     *
     * @param  \App\Models\FilamentBlog\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     *
     * @param  \App\Models\FilamentBlog\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
