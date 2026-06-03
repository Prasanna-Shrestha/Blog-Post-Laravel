<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\PostStatus;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::whereHas('roles', function($q){
            $q->where('name', 'user'); 
        })->get();

        foreach($users as $user){
            $post1 = Post::create([
                'title'=>"Blog Test: { $user->id }",
                'slug'=>'',
                'body'=>"This first post has been created from seeder by user : {$user->username}",
                'user_id'=>$user->id,
                'current_status'=>PostStatus::accepted
            ]);
            $slug = Str::slug($post1->title) . '-' . $post1->id;
            $post1->update([
                "slug" => $slug
            ]);

            $post2 = Post::create([
                'title'=>"Blog Test { $user->id }",
                'slug'=>'blog-test',
                'body'=>"This second post has been created from seeder by user : {$user->username}",
                'user_id'=>$user->id,
                'current_status'=>PostStatus::accepted
            ]);
            $slug = Str::slug($post2->title) . '-' . $post2->id;
            $post1->update([
                "slug" => $slug
            ]);
        };
    }
}
