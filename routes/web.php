<?php

use App\Console\Commands\Concerns\CanGeneratePolicy;
use App\Console\Commands\Concerns\CanManipulateFiles;
use App\Events\Blog\Post\PostPublished;
use App\Http\Controllers\Blog\AuthorController;
use App\Http\Controllers\Blog\PostsController;
use App\Http\Controllers\BreakingNewsController;
use App\Models\FilamentBlog\Post;
use App\WebSocket\WebSocketHandler;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Process\Process;

Route::get('/', function () {
    return view('index');
});

Route::get("blog/author/{author}", [AuthorController::class, 'show'])->name('blog.author.profile');
Route::get("blog/author/{category:slug}/posts/{author}", [AuthorController::class, 'showPostsInCategory'])
    ->name('blog.author.posts_in_category');
Route::get("blog/author/{author}/posts", [AuthorController::class, 'showPosts'])->name('blog.author.posts');
Route::get("blog/author/{author}/posts-search", [AuthorController::class, 'searchInPosts'])->name('blog.author.search_posts');

Route::get("blog/post/{post}", [PostsController::class, 'show'])->name('blog.post.show');


Route::impersonate();


Route::get("test", function () {
    $post = Post::factory()->create();
    Notification::make()
    ->title('Saved successfully')
    ->success()
    ->body('Changes to the **post** have been saved.')
    ->actions([
        Action::make('عرض')
            ->button()
            ->url(route('blog.post.show', ['post' => $post->slug])),
    ])
    ->send();
});

Route::get("posts", [BreakingNewsController::class , "getRecentPosts"])->name('breakingnews.get_posts');
