<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Videos\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function show(Request $request, Video $video)
    {
        $video->load([
            'author',
            'categories',
            'tags',
            'media',
        ]);

        $videos = $video->getMedia();
        $total_videos_count = $videos->count();
        $active_video = $videos[request('num', 1) - 1] ?? null;

        return view('videos.show', [
            'video' => $video,
            'active_video' => $active_video,
            'total_videos_count' => $total_videos_count,
            'videos' => $videos,
            'related_videos' => $video->getRelatedVideos(),
        ]);
    }
}
