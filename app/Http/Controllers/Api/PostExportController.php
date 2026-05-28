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
            ->paginate(8);

        return PostResource::collection($posts);
    }
}