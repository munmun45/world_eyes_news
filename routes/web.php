<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

/*
|--------------------------------------------------------------------------
| Front-end Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [NewsController::class, 'index'])->name('home');
Route::get('/category/{slug}', [NewsController::class, 'category'])->name('category.show');
Route::get('/article/{slug}', [NewsController::class, 'show'])->name('article.show');
Route::get('/search', [NewsController::class, 'search'])->name('search');
Route::get('/about', [NewsController::class, 'about'])->name('about');
Route::get('/privacy-policy', [NewsController::class, 'privacy'])->name('privacy.policy');
Route::get('/terms-and-conditions', [NewsController::class, 'terms'])->name('terms.conditions');
Route::post('/article/{id}/comment', [NewsController::class, 'storeComment'])->name('comment.store');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Protected Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('admin')->group(function () {
        Route::get('/', fn () => redirect()->route('admin.dashboard'));
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Articles Management
        Route::get('/articles', [AdminArticleController::class, 'index'])->name('articles.index');
        Route::get('/articles/create', [AdminArticleController::class, 'create'])->name('articles.create');
        Route::post('/articles', [AdminArticleController::class, 'store'])->name('articles.store');
        Route::get('/articles/{id}/edit', [AdminArticleController::class, 'edit'])->name('articles.edit');
        Route::put('/articles/{id}', [AdminArticleController::class, 'update'])->name('articles.update');
        Route::delete('/articles/{id}', [AdminArticleController::class, 'destroy'])->name('articles.destroy');
        Route::post('/articles/{id}/toggle-breaking', [AdminArticleController::class, 'toggleBreaking'])->name('articles.toggleBreaking');
        Route::post('/articles/{id}/toggle-featured', [AdminArticleController::class, 'toggleFeatured'])->name('articles.toggleFeatured');

        // Categories Management
        Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{id}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{id}', [AdminCategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{id}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

        // Comments Management
        Route::get('/comments', [AdminCommentController::class, 'index'])->name('comments.index');
        Route::post('/comments/{id}/toggle', [AdminCommentController::class, 'toggleApprove'])->name('comments.toggle');
        Route::delete('/comments/{id}', [AdminCommentController::class, 'destroy'])->name('comments.destroy');

        // Site Settings
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');

        // Admin Profile
        Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    });
});
