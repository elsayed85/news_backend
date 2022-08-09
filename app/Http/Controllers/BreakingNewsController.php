<?php

namespace App\Http\Controllers;

use App\Models\FilamentBlog\Post;
use Illuminate\Http\Request;

class BreakingNewsController extends Controller
{
    public function getRecentPosts()
    {
        return Post::orderBy("id", "desc")
            ->published()
            ->take(20)
            ->whereHas('category', function ($query) {
                $query->where('slug', '=', 'akhbar-ajalah');
            })
            ->get(['id', 'title', 'slug'])
            ->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'link' => route('blog.post.show', $post->slug),
                ];
            });
    }
}
