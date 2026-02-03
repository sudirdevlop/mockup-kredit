<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with('author');

        if ($request->has('status')) {
            $query->where('status', $request->status);
        } else {
            $query->published();
        }

        $articles = $query->latest('published_at')->paginate($request->get('per_page', 15));
        return response()->json($articles);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        $article = Article::create([
            'author_id' => $request->user()->id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'featured_image' => $request->featured_image,
            'status' => $request->status,
            'published_at' => $request->status === 'published' ? ($request->published_at ?? now()) : null,
        ]);

        return response()->json($article, 201);
    }

    public function show(string $id)
    {
        $article = Article::with('author')->findOrFail($id);
        $article->incrementViews();
        return response()->json($article);
    }

    public function update(Request $request, string $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        $article->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'featured_image' => $request->featured_image,
            'status' => $request->status,
            'published_at' => $request->status === 'published' ? ($request->published_at ?? $article->published_at ?? now()) : null,
        ]);

        return response()->json($article);
    }

    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return response()->json(['message' => 'Article deleted successfully']);
    }
}
