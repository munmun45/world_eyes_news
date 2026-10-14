<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\Article;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('*', function ($view) {
            try {
                if (Schema::hasTable('categories')) {
                    $categories = Category::where('is_active', true)
                        ->withCount(['publishedArticles'])
                        ->orderBy('order')
                        ->get();
                    $view->with('navCategories', $categories);
                } else {
                    $view->with('navCategories', collect());
                }

                if (Schema::hasTable('articles')) {
                    $breakingNews = Article::where('status', 'published')
                        ->where('is_breaking', true)
                        ->latest('published_at')
                        ->take(8)
                        ->get();
                    $view->with('globalBreaking', $breakingNews);
                } else {
                    $view->with('globalBreaking', collect());
                }

                if (Schema::hasTable('settings')) {
                    $settings = Setting::all()->pluck('value', 'key')->toArray();
                    $view->with('siteSettings', $settings);
                } else {
                    $view->with('siteSettings', []);
                }
            } catch (\Exception $e) {
                $view->with('navCategories', collect());
                $view->with('globalBreaking', collect());
                $view->with('siteSettings', []);
            }
        });
    }
}
