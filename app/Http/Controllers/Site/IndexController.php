<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteBaseController;
use App\Models\FilamentBlog\Post;
use App\Models\Videos\Video;
use Illuminate\Http\Request;

class IndexController extends SiteBaseController
{
    public function getUnreadNotificationsCount(){
        
    }
    public function home()
    {
        $recentVideos = Video::Recent()->has("media")->Published()->public()->take(8)->get();
        $topWatchedVideos = Video::Recent()->has("media")->Published()->public()->TopWatched()->take(8)->get();
        return view('index', [
            'recent_videos' => $recentVideos,
            'top_watched_videos' => $topWatchedVideos,
        ]);
    }

    public function topWatchedVideos()
    {
        $videos = Video::Recent()->has("media")->Published()->public()->TopWatched()->paginate(8);
        return view('pages.top_watched_videos', [
            'videos' => $videos
        ]);
    }

    public function recentVideos()
    {
        $videos = Video::Recent()->has("media")->Published()->public()->paginate(8);
        return view('pages.recent_videos', [
            'videos' => $videos
        ]);
    }

    public function Search(Request $request)
    {
        $show_only = collect(['videos', "posts"]);
        $videos = collect();
        $posts = collect();

        if ($request->has('show_only')) {
            $show_only = collect(explode(',', $request->input('show_only')));
        }

        abort_if($show_only->count() == 0, 404);

        if ($show_only->count() && $show_only->contains('videos')) {
            $videos = Video::search($request->input('query_text'))
                ->published()
                ->public()
                ->paginate(8, ['*'], 'videos_page');
        }

        if ($show_only->count() && $show_only->contains('posts')) {
            $posts = Post::search($request->input('query_text'))
                ->published()
                ->public()
                ->paginate(8, ['*'], 'posts_page');
        }

        return view('search', [
            'show_only' => $show_only,
            'videos' => $videos,
            'posts' => $posts
        ]);
    }
}
