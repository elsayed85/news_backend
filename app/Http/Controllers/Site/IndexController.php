<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Videos\Video;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home()
    {
        $recentVideos = Video::Recent()->Published()->take(8)->get();
        $topWatchedVideos = Video::Recent()->Published()->TopWatched()->take(8)->get();
        return view('index', [
            'recent_videos' => $recentVideos,
            'top_watched_videos' => $topWatchedVideos
        ]);
    }

    public function topWatchedVideos()
    {
        $videos = Video::Recent()->Published()->TopWatched()->paginate(8);
        return view('pages.top_watched_videos', [
            'videos' => $videos
        ]);
    }

    public function recentVideos()
    {
        $videos = Video::Recent()->Published()->paginate(8);
        return view('pages.recent_videos', [
            'videos' => $videos
        ]);
    }

    public function videosSearch(Request $request)
    {
        dd($request);
    }
}
