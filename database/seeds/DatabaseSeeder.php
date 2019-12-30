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
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
            ]
        );
        factory(User::class,10)->create();

        for($i = 1; $i <= 10; $i++):
            $this->command->info('Loop'.$i.'Started');
                factory(Post::class,5)->create();
                $this->command->info(PHP_EOL);
            $this->command->info('Loop'.$i.'Ended');
        endfor;
        
        
    }
}
