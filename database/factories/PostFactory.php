<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(Post::class, function (Faker $faker) {
    $postName = $faker->word;
    $postSlug = \Illuminate\Support\Str::slug($postName);
    $postDesc = $faker->sentence;
    $users = User::query()
                ->orderBy('id')
                ->pluck('id')
                ->shuffle();
    return [
        'post_name' => $postName,
        'post_slug' => $postSlug,
        'post_description' => $postDesc,
        'user_id' => $users->first(),
    ];
});
