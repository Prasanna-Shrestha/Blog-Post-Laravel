<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
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
                'title'=>'Blog Test',
                'slug'=>'blog-test',
                'body'=>"This first post has been created from seeder by user : {$user->username}",
                'user_id'=>$user->id
            ]);

            $post2 = Post::create([
                'title'=>'Blog Test',
                'slug'=>'blog-test',
                'body'=>"This second post has been created from seeder by user : {$user->username}",
                'user_id'=>$user->id
            ]);
        };
    }
}
