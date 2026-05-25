<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Override;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user.roles', 'user', 'categories'])
             ->withCount('comments')
             ->latest()
             ->paginate(8);
        $user = auth()->user()->load('roles');
        return view('home', compact('posts', 'user'));
    } 

    public function create(){
        $categories = Category::all();
        return view('create', compact('categories'));
    }

    public function store(Request $request){
        $id = Auth::id();
            
        // 2. Start with the selected existing category IDs (may be empty)
        $categoryIds = collect($request->input('categories', []));

        // 3. Parse the comma-separated new category names
        //    "laptop, gadgets, , phones" → ["laptop", "gadgets", "phones"]
        if ($request->filled('new_categories')) {
            $newNames = collect(explode(',', $request->new_categories))
                ->map(fn ($name) => trim($name))       // strip whitespace
                ->filter(fn ($name) => $name !== '')   // drop empty segments
                ->unique();                            // no duplicates

            // firstOrCreate: inserts if name doesn't exist, returns row either way
            $newIds = $newNames->map(
                fn ($name) => Category::firstOrCreate([
                    'name' => $name,
                    'slug' => "slug"    
                ])->id
            );

            $categoryIds = $categoryIds->merge($newIds)->unique()->values();
        }
        $post = Post::create([
            "title" => $request->title,
            "slug" => "",
            "body" => $request->body,
            "user_id" => $id,
            "current_status" => \App\PostStatus::draft->value,
        ]);

        $slug = Str::slug($request->title) . '-' . $post->id;

        $post->update([
            'slug' => $slug
        ]);
        if ($categoryIds->isNotEmpty()) {
            $post->categories()->sync($categoryIds->all());
        }

        return redirect()->route('show', $post->id)
                        ->with('success', 'Post published.');
    }

    public function show(Request $request, $id){
        $post = Post::with(['user', 'categories', 'comments.user'])
            ->findOrFail($id);    
        return view('show', compact('post'));
    }

    public function comment(Request $request, $id){

        $comment = Comment::create([
            "body" => $request->body,
            "user_id" => Auth::id(),
            "post_id" => $id
        ]);
        return redirect()->route('home'); 
    }
}
