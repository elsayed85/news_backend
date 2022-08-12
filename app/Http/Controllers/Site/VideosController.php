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

        views($video)
            ->cooldown(1)
            ->record();

        return view('videos.show', [
            'video' => $video,
        ]);
    }
}
