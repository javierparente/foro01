<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Entities\User::class, function (Faker\Generator $faker) {

    static $password;

    $user = [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];

    return $user;

});


$factory->define(App\Entities\Post::class, function (Faker\Generator $faker) {

    $post = [
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'pending' => $faker->boolean(),
        'user_id' => function () {
            // Crear un Usuario dentro del Post siempre que no sea personalizado. Crea uno nuevo.
            return factory(\App\Entities\User::class)->create()->id;
        },
    ];

    return $post;

});
