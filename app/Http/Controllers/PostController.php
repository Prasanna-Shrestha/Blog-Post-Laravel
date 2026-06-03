<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\PostStatus;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\UserIsActive;

use function Laravel\Prompts\error;

class PostController extends Controller
{
    public function index()
    {        
        $posts = Post::with(['user.roles', 'categories'])
            ->withCount('comments')
            ->latest()
            ->paginate(8);

        return view('home', compact('posts'));
    }

    public function create(){
        $this->authorize('create', Post::class);
        Gate::authorize('create-post');
        $categories = Category::all();
        return view('create', compact('categories'));
    }

    public function store(PostRequest $request){
        $id = Auth::id();
        $status = $request['action'] === 'submitted'
        ? PostStatus::submitted
        : PostStatus::draft;
            
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
                    'slug' => $name    
                ])->id
            );

            $categoryIds = $categoryIds->merge($newIds)->unique()->values();
        }
        $post = Post::create([
            "title" => $request->title,
            "slug" => "",
            "body" => $request->body,
            "user_id" => $id,
            "current_status" => $status,
        ]);

        $slug = Str::slug($request->title) . '-' . $post->id;

        $post->update([
            'slug' => $slug
        ]);
        $post->statuses()->create([
            'status'     => $status->value,
            'changed_by' => Auth::id(),
        ]);
        if ($categoryIds->isNotEmpty()) {
            $post->categories()->sync($categoryIds->all());
        }

        $message = $status === PostStatus::submitted
            ? 'Post submitted for review.'
            : 'Draft saved.';
    
        return view('show', compact('post'))->with('status', 'Post created successfully');
    }

    public function show($slug){
        $post = Post::with(['user', 'categories', 'comments.user'])
            ->where('slug', $slug)->first();    
        return view('show', compact('post'));
    }

    public function comment(Request $request, $id){
        Gate::authorize('add-comment');
        $request->validate([
            'body' => 'required|string|max:500'
        ]);

        $comment = Comment::create([
            "body" => $request->body,
            "user_id" => Auth::id(),
            "post_id" => $id
        ]);
        return redirect()->route('home'); 
    }

    public function profile(Request $request)
    {   
        $request->validate([
            'tab' => 'nullable|in:draft,pending,accepted,rejected',
        ]);
        $user = Auth::user();
        $tab  = $request->get('tab', 'draft');

        // Map tab name to the status value used in current_status
        $statusMap = [
            'draft'    => 'draft',
            'pending'  => 'submitted',
            'accepted' => 'accepted',
            'rejected' => 'rejected',
        ];

        $currentStatus = $statusMap[$tab] ?? 'draft';

        $posts = Post::with(['categories', 'statuses'])
            ->withCount('comments')
            ->where('user_id', $user->id)
            ->where('current_status', $currentStatus)
            ->latest()
            ->paginate(10);

        $counts = [
            'draft'    => Post::where('user_id', $user->id)->where('current_status', 'draft')->count(),
            'submitted'=> Post::where('user_id', $user->id)->where('current_status', 'submitted')->count(),
            'accepted' => Post::where('user_id', $user->id)->where('current_status', 'accepted')->count(),
            'rejected' => Post::where('user_id', $user->id)->where('current_status', 'rejected')->count(),
        ];

        return view('profile', compact('user', 'posts', 'counts'));
    }

    public function edit(Post $post)
    {
        // Must have edit-any OR (edit-own AND it's their post)
        if (!Gate::allows('edit-any-post')) {
            if (!Gate::allows('edit-own-post') || $post->user_id !== Auth::id()) {
                abort(403);
            }
        }
        $categories = Category::all();
        return view('create', compact('categories', 'post'));
    }

    public function update(Request $request, Post $post)
    {
        if (!Gate::allows('edit-any-post')) {
            if (!Gate::allows('edit-own-post') || $post->user_id !== Auth::id()) {
                abort(403);
            }
        }

        $request->validate([
            'title'      => 'required|string|max:255',
            'body'       => 'required|string',
            'categories' => 'nullable|string',
        ]);

        // Parse the comma-separated category names from the edit field
        $categoryIds = collect();

        if ($request->filled('categories')) {
            $names = collect(explode(',', $request->categories))
                ->map(fn($name) => trim($name))
                ->filter(fn($name) => $name !== '')
                ->unique();

            $categoryIds = $names->map(
                fn($name) => Category::firstOrCreate(
                    ['name' => $name],
                    ['slug' => Str::slug($name)]
                )->id
            );
        }

        // Regenerate slug from updated title
        $slug = Str::slug($request->title) . '-' . $post->id;

        $post->update([
            'title'          => $request->title,
            'slug'           => $slug,
            'body'           => $request->body,
            'current_status' => "submitted",
        ]);

        $post->statuses()->create([
            'status'     => "submitted",
            'changed_by' => Auth::id(),
        ]);

        $post->categories()->sync($categoryIds->all());

        $message = "Edit";

        return redirect()->route('show', $post->slug)
                        ->with('success', $message);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if (!Gate::allows('delete-any-post')) {
            if (!Gate::allows('delete-own-post') || $post->user_id !== Auth::id()) {
                abort(403);
            }
        }
        $post->categories()->detach();
        $post->comments()->delete();
        $post->statuses()->delete();
        $post->delete();
        return redirect()->route('home')->with('status', 'Post deleted');
    }

    public function publish(Request $request, Post $post){
        $this->authorize('publish', $post);
        $validated = $request->validate([
            'status' => 'required|string|in:draft,submitted,accepted,rejected',
        ]);

        $post->statuses()->create([
            'status' => $validated['status'],
            'changed_by' => Auth::id()
        ]);
        $post->update(['current_status' => $validated['status']]);
        return redirect()->back()->with('success', 'Status updated successfully!');
    }
        
    public function submit(Post $post){
        $this->authorize('submit', $post);
        $post->statuses()->create([
            'status' => "submitted",
            'changed_by' => Auth::id()
        ]);
        $post->update(['current_status' => 'submitted']);


        return redirect()->back()->with('success', 'Status updated successfully!');
    }

    public function reject(Request $request, Post $post){
        $this->authorize('publish', $post);
        $validated = $request->validate([
            'status' => 'required|string|in:draft,submitted,accepted,rejected',
        ]);

        $post->statuses()->create([
            'status' => $validated['status'],
            'changed_by' => Auth::id()
        ]);
        $post->update(['current_status' => "rejected"]);

        return redirect()->back()->with('success', 'Status updated successfully!');
    }
}
