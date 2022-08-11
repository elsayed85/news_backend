<?php

use App\Console\Commands\Concerns\CanGeneratePolicy;
use App\Console\Commands\Concerns\CanManipulateFiles;
use App\Events\Blog\Post\PostPublished;
use App\Http\Controllers\Blog\AuthorController;
use App\Http\Controllers\Blog\PostsController;
use App\Http\Controllers\BreakingNewsController;
use App\Http\Controllers\Site\VideosController;
use App\Models\FilamentBlog\Post;
use App\Models\User;
use App\Models\Videos\Category;
use App\Models\Videos\Video;
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


Route::get("videos/{video:slug}", [VideosController::class, "show"])->name('videos.show');

Route::get("blog/post/{post}", [PostsController::class, 'show'])->name('blog.post.show');


Route::impersonate();


Route::get("test", function () {
    return phpinfo();
    $category2 = Category::create([
        'name' => 'Test Category2',
        'slug' => 'test-category2' . rand(0, 100),
    ]);

    $category1 = Category::create([
        'name' => 'Test Category 1',
        'slug' => 'test-category1' . rand(0, 100),
    ]);

    $user = User::factory()->create();
    $video = Video::create([
        'title' => 'Test Video',
        'content' => 'Test Description',
        'user_id' => $user->id,
        'published_at' => now(),
        'slug' => 'test-video' . rand(0, 100),
    ]);

    $video->categories()->sync([$category1->id, $category2->id]);

    dd($video->categories);



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

Route::get("posts", [BreakingNewsController::class, "getRecentPosts"])->name('breakingnews.get_posts');
