<?php

namespace App\Providers;

use App\Filament\OveridedResources\AuthorResource as AuthorResource2;
use App\Filament\OveridedResources\PostResource as PostResources2;
use App\Http\Livewire\Filament\Auth\Login as AuthLogin;
use Filament\Http\Livewire\Auth\Login;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Stephenjude\FilamentBlog\Resources\AuthorResource;
use Stephenjude\FilamentBlog\Resources\PostResource;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
        $loader = AliasLoader::getInstance();
        $loader->alias(PostResource::class, PostResources2::class);
        $loader->alias(AuthorResource::class, AuthorResource2::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Factory::guessFactoryNamesUsing(function (string $model_name) {
            $namespace = 'Database\\Factories\\';
            $model_name = Str::afterLast($model_name, '\\');
            return $namespace . $model_name . 'Factory';
        });
    }
}
