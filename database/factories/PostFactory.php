<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $postName = $faker->word;
    $postSlug = \Illuminate\Support\Str::slug($postName);
    $postDesc = $faker->sentence;
    return [
        'post_name' => $postName,
        'post_slug' => $postSlug,
        'post_description' => $postDesc,
    ];
});
