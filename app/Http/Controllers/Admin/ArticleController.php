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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif,avif|max:10240',
            'image_url' => 'nullable|string|max:1000',
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

        // Handle Image upload or external URL
        $article->image = $this->handleImageUpload($request);

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif,avif|max:10240',
            'image_url' => 'nullable|string|max:1000',
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

        // Handle Image replacement or external URL update
        $article->image = $this->handleImageUpload($request, $article->image);

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
            $this->deleteLocalImage($article->image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully.');
    }

    /**
     * Handle local file upload and external URL input reliably.
     */
    protected function handleImageUpload(Request $request, $existingImage = null)
    {
        // 1. Direct local file upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = strtolower($file->getClientOriginalExtension() ?: 'jpg');
            $fileName = time() . '_' . Str::random(12) . '.' . $extension;

            // Direct public uploads directory (served directly by web server without symlink dependencies)
            $publicUploadPath = public_path('uploads/articles');
            if (!file_exists($publicUploadPath)) {
                mkdir($publicUploadPath, 0755, true);
            }

            // Also keep a copy in storage/app/public/articles
            $storageArticlesPath = storage_path('app/public/articles');
            if (!file_exists($storageArticlesPath)) {
                mkdir($storageArticlesPath, 0755, true);
            }

            // Move uploaded file to public/uploads/articles
            $file->move($publicUploadPath, $fileName);

            // Copy to storage/app/public/articles
            @copy($publicUploadPath . DIRECTORY_SEPARATOR . $fileName, $storageArticlesPath . DIRECTORY_SEPARATOR . $fileName);

            // Delete old uploaded file
            if ($existingImage && !str_starts_with($existingImage, 'http') && !str_starts_with($existingImage, 'images/')) {
                $this->deleteLocalImage($existingImage);
            }

            return 'uploads/articles/' . $fileName;
        }

        // 2. External URL provided
        $rawUrl = trim($request->input('image_url', ''));
        if (!empty($rawUrl)) {
            if (!str_starts_with($rawUrl, 'http://') && !str_starts_with($rawUrl, 'https://') && !str_starts_with($rawUrl, '//')) {
                $rawUrl = 'https://' . $rawUrl;
            }
            if ($existingImage && !str_starts_with($existingImage, 'http') && !str_starts_with($existingImage, 'images/')) {
                $this->deleteLocalImage($existingImage);
            }
            return $rawUrl;
        }

        // 3. Keep existing image if neither new file nor new URL provided
        return $existingImage;
    }

    /**
     * Delete locally uploaded image files from disk.
     */
    protected function deleteLocalImage($image)
    {
        if (empty($image)) {
            return;
        }

        $clean = ltrim($image, '/\\');
        @unlink(public_path($clean));
        @unlink(public_path('uploads/' . $clean));
        @unlink(public_path('storage/' . $clean));
        @unlink(storage_path('app/public/' . str_replace('uploads/articles/', 'articles/', $clean)));
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
