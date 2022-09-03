<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\FilamentBlog\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        return view('blog.posts.show', [
            'post' => $post,
            'attachments' => $post->getMedia()
        ]);
    }
}
