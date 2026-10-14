<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_articles' => Article::count(),
            'published_articles' => Article::where('status', 'published')->count(),
            'draft_articles' => Article::where('status', 'draft')->count(),
            'breaking_articles' => Article::where('is_breaking', true)->count(),
            'total_categories' => Category::count(),
            'total_comments' => Comment::count(),
            'total_views' => Article::sum('views_count'),
            'total_users' => User::count(),
        ];

        $recentArticles = Article::with(['category', 'author'])
            ->latest()
            ->take(6)
            ->get();

        $topArticles = Article::with('category')
            ->orderByDesc('views_count')
            ->take(5)
            ->get();

        $recentComments = Comment::with('article')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentArticles', 'topArticles', 'recentComments'));
    }
}
