<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostExportController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'categories'])
            ->withCount('comments')
            ->where('current_status', 'accepted')
            ->latest()
            ->paginate(10);

        return PostResource::collection($posts);
    }
    public function show(Post $post)
    {
        $post->load([
            'user',
            'categories'
        ])->loadCount('comments');

        if ($post->current_status !== 'accepted') {
            abort(403);
        }

        return new PostResource($post);
    }
}