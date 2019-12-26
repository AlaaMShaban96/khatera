<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\Model;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'id'=>1,
        'user_id'=>null,
        'titel' => $faker->sentence,
        'website_link'=>"",
        'public'=>1,
        'image' => UploadedFile::fake()->image('avatar.jpg'),
        'content' => $faker->paragraph,
        'period' => 1,
   
    ];
});
