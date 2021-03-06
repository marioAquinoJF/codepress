<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(CodePress\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
$factory->define(CodePress\CodeCategory\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'active' => true
    ];
});
$factory->define(CodePress\CodePost\Models\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->title,
        'content' => $faker->paragraph
    ];
});

$factory->define(CodePress\CodePost\Models\Comment::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->paragraph
    ];
});
