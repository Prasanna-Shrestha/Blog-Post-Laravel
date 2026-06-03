<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserIsActive;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserIsActiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function ($user) {
            UserIsActive::firstOrCreate(
                ['user_id'   => $user->id]
            );
        });
    }
}
