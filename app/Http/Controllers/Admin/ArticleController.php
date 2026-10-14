<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['category', 'author'])->latest();

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                    ->orWhere('summary', 'like', "%{$s}%")
                    ->orWhere('tags', 'like', "%{$s}%");
            });
        }

        $articles = $query->paginate(12)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif|max:10240',
            'image_url' => 'nullable|url|max:1000',
            'image_caption' => 'nullable|string|max:255',
            'is_breaking' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'is_trending' => 'nullable|boolean',
            'status' => 'required|in:published,draft',
            'tags' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $article = new Article();
        $article->title = $validated['title'];
        $article->category_id = $validated['category_id'];
        $article->user_id = Auth::id();
        $article->summary = $validated['summary'] ?? null;
        $article->content = $validated['content'];
        $article->image_caption = $validated['image_caption'] ?? null;
        $article->is_breaking = $request->boolean('is_breaking');
        $article->is_featured = $request->boolean('is_featured');
        $article->is_trending = $request->boolean('is_trending');
        $article->status = $validated['status'];
        $article->tags = $validated['tags'] ?? null;
        $article->meta_title = $validated['meta_title'] ?? $validated['title'];
        $article->meta_description = $validated['meta_description'] ?? Str::limit(strip_tags($validated['summary'] ?? $validated['content']), 160);

        // Handle Image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
            $article->image = $path;
        } elseif (!empty($validated['image_url'])) {
            $article->image = $validated['image_url'];
        }

        if ($article->status === 'published') {
            $article->published_at = now();
        }

        $article->save();

        return redirect()->route('admin.articles.index')->with('success', 'Article "' . $article->title . '" created successfully!');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:articles,slug,' . $article->id,
            'category_id' => 'required|exists:categories,id',
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif|max:10240',
            'image_url' => 'nullable|url|max:1000',
            'image_caption' => 'nullable|string|max:255',
            'is_breaking' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'is_trending' => 'nullable|boolean',
            'status' => 'required|in:published,draft',
            'tags' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $article->title = $validated['title'];
        $article->slug = Str::slug($validated['slug']);
        $article->category_id = $validated['category_id'];
        $article->summary = $validated['summary'] ?? null;
        $article->content = $validated['content'];
        $article->image_caption = $validated['image_caption'] ?? null;
        $article->is_breaking = $request->boolean('is_breaking');
        $article->is_featured = $request->boolean('is_featured');
        $article->is_trending = $request->boolean('is_trending');
        $article->status = $validated['status'];
        $article->tags = $validated['tags'] ?? null;
        $article->meta_title = $validated['meta_title'] ?? $validated['title'];
        $article->meta_description = $validated['meta_description'] ?? null;

        if ($request->hasFile('image')) {
            // Delete old file if stored locally
            if ($article->image && !str_starts_with($article->image, 'http') && !str_starts_with($article->image, 'images/')) {
                Storage::disk('public')->delete($article->image);
            }
            $path = $request->file('image')->store('articles', 'public');
            $article->image = $path;
        } elseif (!empty($validated['image_url'])) {
            $article->image = $validated['image_url'];
        }

        if ($article->status === 'published' && !$article->published_at) {
            $article->published_at = now();
        }

        $article->save();

        return redirect()->route('admin.articles.index')->with('success', 'Article updated successfully!');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if ($article->image && !str_starts_with($article->image, 'http') && !str_starts_with($article->image, 'images/')) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully.');
    }

    public function toggleBreaking($id)
    {
        $article = Article::findOrFail($id);
        $article->is_breaking = !$article->is_breaking;
        $article->save();

        return back()->with('success', 'Breaking news status updated.');
    }

    public function toggleFeatured($id)
    {
        $article = Article::findOrFail($id);
        $article->is_featured = !$article->is_featured;
        $article->save();

        return back()->with('success', 'Featured status updated.');
    }
}
