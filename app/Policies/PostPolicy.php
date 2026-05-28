<?php

namespace App\Policies;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\PostStatus;

class PostPolicy
{
    protected $policies = [
        Post::class => PostPolicy::class,
    ];
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function create(User $user): bool {
        if ($user){
            return true;
        }
    }
    public function view(?User $user, Post $post): bool
    {
        if ($user?->isAdmin()) {
            return true;
        }

        if ($user?->id === $post->user_id) {
            return true;
        }

        return $post->current_status->value === 'accepted';
    }

    public function update(User $user, Post $post): bool
    {
        // return $user->id === $post->user_id
        //     || $user->isAdmin();
        return $user->id === $post->user_id;
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id
            || $user->isAdmin();
    }

    public function publish(User $user, Post $post): bool
    {
        return $user->isAdmin() && $post->current_status == PostStatus::submitted;
    }

    public function reject(User $user, Post $post): bool
    {
        return $user->isAdmin() && $post->current_status == PostStatus::submitted;
    }
        
    public function submit(User $user): bool
    {
        if (!$user) {
            return false;
        }
        return true;
    }
}
