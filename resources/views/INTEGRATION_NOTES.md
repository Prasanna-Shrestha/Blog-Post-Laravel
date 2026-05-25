# Blade Views — Integration Notes

## File placement

| Blade file | Destination |
|---|---|
| `register.blade.php` | `resources/views/auth/register.blade.php` |
| `login.blade.php` | `resources/views/auth/login.blade.php` |
| `home.blade.php` | `resources/views/home.blade.php` |
| `show.blade.php` | `resources/views/posts/show.blade.php` |
| `vendor/pagination/custom.blade.php` | `resources/views/vendor/pagination/custom.blade.php` |

---

## Routes expected (web.php)

```php
// Auth
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [PasswordResetController::class, 'showRequest'])
    ->name('password.request');

// Public
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

// Auth-protected
Route::post('/posts/{id}/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('posts.comments.store');
```

---

## Controller expectations

### AuthController@register (POST /register)
Validate:
```php
'username'              => 'required|string|max:50|unique:users,username',
'email'                 => 'required|email|unique:users,email',
'password'              => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z]).+$/|confirmed',
'role'                  => 'nullable|in:user,admin',
```

### AuthController@login (POST /login)
Accept `login` field as either username or email:
```php
$field = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
Auth::attempt([$field => $request->login, 'password' => $request->password], $request->remember);
```

### PostController@index
Pass paginated posts (8 per page) with eager-loaded relations:
```php
$posts = Post::with(['user', 'categories'])
            //  ->withCount('comments')
             ->latest()
             ->paginate(8);
return view('home', compact('posts'));
```

### PostController@show
```php
$post = Post::with(['user', 'categories', 'comments.user'])->findOrFail($id);
return view('posts.show', compact('post'));
```

### CommentController@store
```php
$request->validate(['body' => 'required|string|max:1000']);
$post->comments()->create([
    'user_id' => auth()->id(),
    'body'    => $request->body,
]);
return back()->with('comment_success', 'Comment posted.');
```

---

## Model relationships needed

```php
// User
public function posts()    { return $this->hasMany(Post::class); }
public function comments() { return $this->hasMany(Comment::class); }

// Post
public function user()       { return $this->belongsTo(User::class); }
public function categories() { return $this->belongsToMany(Category::class); }
public function comments()   { return $this->hasMany(Comment::class); }

// Comment
public function user() { return $this->belongsTo(User::class); }
public function post() { return $this->belongsTo(Post::class); }
```

---

## Pagination — use custom view

In `AppServiceProvider::boot()`:
```php
Paginator::defaultView('vendor.pagination.custom');
```
Or keep calling it explicitly: `$posts->links('vendor.pagination.custom')`.

---

## Users table — add `username` column

```php
// Migration
$table->string('username', 50)->unique()->after('id');
$table->string('role', 20)->default('user')->after('password');
```

Add `username` to `$fillable` on the `User` model.



        <!-- {{-- Pagination --}}
        @if ($posts->hasPages())
            <div class="pagination-wrap">
                {{ $posts->links('vendor.pagination.custom') }}
            </div>
        @endif -->