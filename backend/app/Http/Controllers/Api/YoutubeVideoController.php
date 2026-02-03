<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\YoutubeVideo;
use Illuminate\Http\Request;

class YoutubeVideoController extends Controller
{
    public function index(Request $request)
    {
        $query = YoutubeVideo::query();

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        if ($request->has('is_featured')) {
            $query->featured();
        }

        $videos = $query->latest()->paginate($request->get('per_page', 15));
        return response()->json($videos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'youtube_id' => 'required|string|max:255',
            'thumbnail_url' => 'nullable|url',
            'category' => 'nullable|string|max:255',
            'duration' => 'nullable|integer',
            'is_featured' => 'boolean',
        ]);

        $video = YoutubeVideo::create($request->all());
        return response()->json($video, 201);
    }

    public function show(string $id)
    {
        $video = YoutubeVideo::findOrFail($id);
        $video->incrementViews();
        return response()->json($video);
    }

    public function update(Request $request, string $id)
    {
        $video = YoutubeVideo::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'youtube_id' => 'required|string|max:255',
            'thumbnail_url' => 'nullable|url',
            'category' => 'nullable|string|max:255',
            'duration' => 'nullable|integer',
            'is_featured' => 'boolean',
        ]);

        $video->update($request->all());
        return response()->json($video);
    }

    public function destroy(string $id)
    {
        $video = YoutubeVideo::findOrFail($id);
        $video->delete();

        return response()->json(['message' => 'Video deleted successfully']);
    }
}
