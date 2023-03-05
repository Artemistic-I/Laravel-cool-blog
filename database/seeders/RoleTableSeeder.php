<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $s = new Role;
        $s->name = "admin";
        $s->save();

        $s = new Role;
        $s->name = "editor";
        $s->save();

        $s = new Role;
        $s->name = "writer";
        $s->save();

        $s = new Role;
        $s->name = "reader";
        $s->save();

        $s = new Role;
        $s->name = "guest";
        $s->save();

        $s = new Role;
        $s->name = "moderator";
        $s->save();
    }
}
