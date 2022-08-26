<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Videos\Video;
use App\Notifications\NewVideoNotify;

class VideoObserver
{
    /**
     * Handle the Video "created" event.
     *
     * @param  \App\Models\Videos\Video  $video
     * @return void
     */
    public function created(Video $video)
    {
        if ($video->isPublished() && ($video->isPublic() && $video->has('readers'))) {
            $video->readers->each(function (User $reader) use ($video) {
                $reader->notify(new NewVideoNotify($video));
            });
        }
    }

    /**
     * Handle the Video "updated" event.
     *
     * @param  \App\Models\Videos\Video  $video
     * @return void
     */
    public function updated(Video $video)
    {
        //
    }

    /**
     * Handle the Video "deleted" event.
     *
     * @param  \App\Models\Videos\Video  $video
     * @return void
     */
    public function deleted(Video $video)
    {
        //
    }

    /**
     * Handle the Video "restored" event.
     *
     * @param  \App\Models\Videos\Video  $video
     * @return void
     */
    public function restored(Video $video)
    {
        //
    }

    /**
     * Handle the Video "force deleted" event.
     *
     * @param  \App\Models\Videos\Video  $video
     * @return void
     */
    public function forceDeleted(Video $video)
    {
        //
    }
}
