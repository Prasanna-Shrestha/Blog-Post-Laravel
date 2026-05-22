<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // 3 admin users
        $admin1 = User::factory()->create([
            'username' => 'Pop',
            'email' => 'pop@gmail.com',
            'password' => 'pop@12345'
        ]);
        $admin2 = User::factory()->create([
            'username' => 'Prasanna',
            'email' => 'prasanna@gmail.com',
            'password' => 'prasanna@12345'
        ]);
        
        $admin3 = User::factory()->create([
            'username' => 'Buddha Tech',
            'email' => 'buddhatech@gmail.com',
            'password' => 'buddhatech@12345'
        ]);

        // 10 users
        $user1 = User::factory()->create([
            'username' => 'Aavash',
            'email' => 'aavash@example.com',
            'password' => 'aavash@12345'
        ]);
        $user2 = User::factory()->create([
            'username' => 'Sudip',
            'email' => 'sudip@example.com',
            'password' => 'sudip@12345'
        ]);
        $user3 = User::factory()->create([
            'username' => 'Eric',
            'email' => 'eric@example.com',
            'password' => 'eric@12345'
        ]);
        $user4 = User::factory()->create([
            'username' => 'Miraj',
            'email' => 'miraj@example.com',
            'password' => 'miraj@12345'
        ]);
        $user5 = User::factory()->create([
            'username' => 'Anil',
            'email' => 'anil@example.com',
            'password' => 'anil@12345'
        ]);
        $user6 = User::factory()->create([
            'username' => 'silon',
            'email' => 'silon@example.com',
            'password' => 'silon@12345'
        ]);
        $user7 = User::factory()->create([
            'username' => 'Hridaya',
            'email' => 'hridaya@example.com',
            'password' => 'hridaya@12345'
        ]);
        $user8 = User::factory()->create([
            'username' => 'Bhargav',
            'email' => 'bhargav@example.com',
            'password' => 'bhargav@12345'
        ]);
        $user9 = User::factory()->create([
            'username' => 'Niruta',
            'email' => 'niruta@example.com',
            'password' => 'niruta@12345'
        ]);
        $user10 = User::factory()->create([
            'username' => 'Ridhima',
            'email' => 'ridhima@example.com',
            'password' => 'ridhima@12345'
        ]);

        // extract roles from roles table
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        // link user and their roles
        $admin1->roles()->attach($adminRole->id);
        $admin2->roles()->attach($adminRole->id);
        $admin3->roles()->attach($adminRole->id);
        
        $user1->roles()->attach($userRole->id);
        $user2->roles()->attach($userRole->id);
        $user3->roles()->attach($userRole->id);
        $user4->roles()->attach($userRole->id);
        $user5->roles()->attach($userRole->id);
        $user6->roles()->attach($userRole->id);
        $user7->roles()->attach($userRole->id);
        $user8->roles()->attach($userRole->id);
        $user9->roles()->attach($userRole->id);
        $user10->roles()->attach($userRole->id);
        
    }
}
