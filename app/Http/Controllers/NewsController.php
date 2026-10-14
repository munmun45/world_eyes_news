<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;

class NewsController extends Controller
{
    /**
     * Homepage
     */
    public function index()
    {
        // 1. Lead Hero Story
        $leadStory = Article::where('status', 'published')
            ->where('is_featured', true)
            ->latest('published_at')
            ->with(['category', 'author'])
            ->first();

        if (!$leadStory) {
            $leadStory = Article::where('status', 'published')
                ->latest('published_at')
                ->with(['category', 'author'])
                ->first();
        }

        $excludeIds = $leadStory ? [$leadStory->id] : [];

        // 2. Secondary Featured Stories (up to 4)
        $secondaryStories = Article::where('status', 'published')
            ->whereNotIn('id', $excludeIds)
            ->where('is_featured', true)
            ->latest('published_at')
            ->with(['category', 'author'])
            ->take(4)
            ->get();

        if ($secondaryStories->count() < 4) {
            $additional = Article::where('status', 'published')
                ->whereNotIn('id', array_merge($excludeIds, $secondaryStories->pluck('id')->toArray()))
                ->latest('published_at')
                ->with(['category', 'author'])
                ->take(4 - $secondaryStories->count())
                ->get();
            $secondaryStories = $secondaryStories->concat($additional);
        }

        $excludeIds = array_merge($excludeIds, $secondaryStories->pluck('id')->toArray());

        // 3. Trending Articles (6 items)
        $trendingArticles = Article::where('status', 'published')
            ->where('is_trending', true)
            ->latest('published_at')
            ->with(['category', 'author'])
            ->take(6)
            ->get();

        if ($trendingArticles->count() < 6) {
            $additionalTrending = Article::where('status', 'published')
                ->whereNotIn('id', $trendingArticles->pluck('id')->toArray())
                ->orderByDesc('views_count')
                ->with(['category', 'author'])
                ->take(6 - $trendingArticles->count())
                ->get();
            $trendingArticles = $trendingArticles->concat($additionalTrending);
        }

        // 4. Most Viewed
        $mostViewed = Article::where('status', 'published')
            ->orderByDesc('views_count')
            ->with(['category'])
            ->take(6)
            ->get();

        // 5. Category Sections with articles
        $categoriesWithArticles = Category::where('is_active', true)
            ->with(['publishedArticles' => function ($query) {
                $query->latest('published_at')->with('author')->take(5);
            }])
            ->orderBy('order')
            ->get();

        // 6. Latest Quick Feed
        $latestFeed = Article::where('status', 'published')
            ->latest('published_at')
            ->with('category')
            ->take(10)
            ->get();

        return view('frontend.index', compact(
            'leadStory',
            'secondaryStories',
            'trendingArticles',
            'mostViewed',
            'categoriesWithArticles',
            'latestFeed'
        ));
    }

    /**
     * Category View
     */
    public function category(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $query = Article::where('category_id', $category->id)
            ->where('status', 'published')
            ->with(['author', 'category']);

        // Optional filter
        if ($request->has('sort') && $request->sort === 'popular') {
            $query->orderByDesc('views_count');
        } else {
            $query->latest('published_at');
        }

        $articles = $query->paginate(9)->withQueryString();

        $trendingCategory = Article::where('category_id', $category->id)
            ->where('status', 'published')
            ->orderByDesc('views_count')
            ->take(5)
            ->get();

        $latestGeneral = Article::where('status', 'published')
            ->latest('published_at')
            ->with('category')
            ->take(5)
            ->get();

        return view('frontend.category', compact('category', 'articles', 'trendingCategory', 'latestGeneral'));
    }

    /**
     * Single Article Details
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->with(['category', 'author', 'comments'])
            ->firstOrFail();

        // Increment view count
        $article->increment('views_count');

        // Related Articles from same category
        $relatedArticles = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->latest('published_at')
            ->with(['category', 'author'])
            ->take(4)
            ->get();

        // Next and Previous articles
        $prevArticle = Article::where('id', '<', $article->id)
            ->where('status', 'published')
            ->orderBy('id', 'desc')
            ->first();

        $nextArticle = Article::where('id', '>', $article->id)
            ->where('status', 'published')
            ->orderBy('id', 'asc')
            ->first();

        // Trending for sidebar
        $trendingSidebar = Article::where('status', 'published')
            ->orderByDesc('views_count')
            ->with('category')
            ->take(5)
            ->get();

        return view('frontend.details', compact('article', 'relatedArticles', 'prevArticle', 'nextArticle', 'trendingSidebar'));
    }

    /**
     * Search Articles
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        $articles = Article::where('status', 'published')
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('summary', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%")
                    ->orWhere('tags', 'like', "%{$query}%");
            })
            ->latest('published_at')
            ->with(['category', 'author'])
            ->paginate(10)
            ->withQueryString();

        return view('frontend.search', compact('articles', 'query'));
    }

    /**
     * Store Comment
     */
    public function storeComment(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'comment' => 'required|string|min:3|max:2000',
        ]);

        $comment = new Comment();
        $comment->article_id = $article->id;
        $comment->name = $validated['name'];
        $comment->email = $validated['email'];
        $comment->comment = $validated['comment'];
        $comment->is_approved = true;
        $comment->save();

        return redirect()->back()->with('comment_success', 'Thank you! Your comment has been published successfully.');
    }
}
