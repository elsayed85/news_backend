<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\FilamentBlog\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        views($post)
            ->cooldown(1)
            ->record();
        dd($post);
    }
}
