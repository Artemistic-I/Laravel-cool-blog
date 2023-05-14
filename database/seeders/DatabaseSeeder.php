<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use Illuminate\Support\Str;

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
        //adding admin user
        $user = new User;
        $user->name = 'Lemon admin';
        $user->email = 'lemon@lemon.com';
        $user->email_verified_at = now();
        $user->password = '11111111';
        $user->remember_token = Str::random(10);
        $user->save();
        $roles = \App\Models\Role::get();
        foreach ($roles as $role) {
            if ($role->name == 'admin') {
                $user->roles()->attach($role->id);
            }
        }

        //seeding everything else
        \App\Models\Post::factory(100)->create();
        \App\Models\Image::factory(100)->create();
        \App\Models\Comment::factory(1000)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
