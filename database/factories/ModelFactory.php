<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Entities\User::class, function(Faker\Generator $faker) {

    static $password;

    $user = [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];

    return $user;

});


$factory->define(App\Entities\Post::class, function(Faker\Generator $faker) {

    $post = [
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'pending' => $faker->boolean(),
        'user_id' => function () {
            // Create a User inside of the Post whenever it is not personalized. Create a new one.
            return factory(\App\Entities\User::class)->create()->id;
        },
    ];

    return $post;

});

$factory->define(App\Entities\Comment::class, function(Faker\Generator $faker){

    $comment = [
        'comment' => $faker->paragraph,
        'post_id' => function () {
            // Create a Post inside the Comment.
            return factory(\App\Entities\Post::class)->create()->id;
        },
        'user_id' => function () {
            // Create a User inside of the Post whenever it is not personalized. Create a new one.
            return factory(\App\Entities\User::class)->create()->id;
        }
    ];

    return $comment;

});


