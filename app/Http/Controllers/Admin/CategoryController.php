<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('articles')->orderBy('order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'slug' => 'nullable|string|max:100|unique:categories,slug',
            'description' => 'nullable|string',
            'color' => 'required|string|max:20',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $category = new Category();
        $category->name = $validated['name'];
        $category->slug = !empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['name']);
        $category->description = $validated['description'] ?? null;
        $category->color = $validated['color'];
        $category->order = $validated['order'] ?? 0;
        $category->is_active = $request->boolean('is_active', true);
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category "' . $category->name . '" created successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
            'slug' => 'required|string|max:100|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'color' => 'required|string|max:20',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $category->name = $validated['name'];
        $category->slug = Str::slug($validated['slug']);
        $category->description = $validated['description'] ?? null;
        $category->color = $validated['color'];
        $category->order = $validated['order'] ?? 0;
        $category->is_active = $request->boolean('is_active');
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::withCount('articles')->findOrFail($id);

        if ($category->articles_count > 0) {
            return back()->with('error', 'Cannot delete category "' . $category->name . '" because it contains ' . $category->articles_count . ' articles. Please reassign or delete them first.');
        }

        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
