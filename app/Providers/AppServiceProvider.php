<?php

namespace App\Providers;

use App\Filament\OveridedResources\AuthorResource as AuthorResource2;
use App\Filament\OveridedResources\CategoryResource as CategoryResource2;
use App\Filament\OveridedResources\PostResource as PostResources2;
use App\Http\Livewire\Filament\Auth\Login as AuthLogin;
use Filament\Facades\Filament;
use Filament\Http\Livewire\Auth\Login;
use Filament\Navigation\NavigationItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Stephenjude\FilamentBlog\Resources\AuthorResource;
use Stephenjude\FilamentBlog\Resources\CategoryResource;
use Stephenjude\FilamentBlog\Resources\PostResource;

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
        $loader->alias(CategoryResource::class, CategoryResource2::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Factory::guessFactoryNamesUsing(function (string $model_name) {
            $namespace = 'Database\\Factories\\';
            $model_name = Str::afterLast($model_name, '\\');
            return $namespace . $model_name . 'Factory';
        });

        Filament::serving(function () {
            Filament::registerNavigationItems([
                NavigationItem::make(trans('languages.title'))
                    ->url(url(config('translation.ui_url')), shouldOpenInNewTab: true)
                    ->icon('heroicon-o-translate')
                    ->group(__('languages.title'))
                    ->sort(3),
            ]);
        });
    }
}
