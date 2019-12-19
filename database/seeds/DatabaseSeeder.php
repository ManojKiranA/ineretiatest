<?php

use App\Post;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create(
            [
                'name' => 'Admin',
                'email' => 'admin.admin.com',
                'password' => Hash::make('password'),
            ]
        );
        factory(User::class,500)->create();
        factory(Post::class,500)->create();
    }
}
