<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stephenjude\FilamentBlog\Models\Author;
use Stephenjude\FilamentBlog\Models\Category;

class AuthorController extends Controller
{
    public function show(Request $request, Author $author)
    {
        return view('blog.author.profile', [
            'author' => $author,
        ]);
    }

    public function showPosts(Request $request, Author $author)
    {
        $posts_categories = Category::with('posts')->whereHas('posts', function ($query) use ($author) {
            $query->where('blog_author_id', $author->id)->take(6);
        })->get();

        return view('blog.author.posts', [
            'author' => $author,
            'posts_categories' => $posts_categories,
        ]);
    }

    public function showPostsInCategory(Request $request, Category $category,  Author $author)
    {
        $posts = $category->posts()->where('blog_author_id', $author->id)->paginate(12);
        return view('blog.categories.posts', [
            'author' => $author,
            'category' => $category,
            'posts' => $posts,
        ]);
    }

    public function searchInPosts(Request $request, Author $author)
    {
        $posts = $author->posts()->where('title', 'like', '%' . $request->get('q') . '%')->paginate(12);
        dd($posts);
    }
}
