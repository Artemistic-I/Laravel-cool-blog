<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //seeding 6 roles
        $this->call(RoleTableSeeder::class);
        //seeding users
        \App\Models\User::factory(50)->create();
        //generating random many-to-many relationships the horrible way
        $users = \App\Models\User::get();
        $num_roles = \App\Models\Role::get()->count();
        foreach ($users as $user) {
            $roles = \App\Models\Role::get();
            $random_roles = $roles->random(rand(1,$num_roles))->pluck('id');
            foreach ($random_roles as $role) {
                $user->roles()->attach($role);
            }
        }
        \App\Models\Post::factory(100)->create();
        \App\Models\Image::factory(70)->create();
        \App\Models\Comment::factory(200)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
