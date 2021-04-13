<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\ModelsTask;
use App\TaskItem;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'permission' => mt_rand(1, 100),
        'position' => mt_rand(1111, 999999),
        'status' => mt_rand(0, 2),
        'isAdmin' =>  mt_rand(0, 1),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'updated_at' => now(),
        'created_at' => now()
    ];
});

$factory->define(ModelsTask::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->name,
        'content' => $faker->name,
        'status' => mt_rand(0, 2),
        'updated_at' => now(),
        'created_at' => now()
    ];
});




