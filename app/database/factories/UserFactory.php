<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Models\ModelsTask;
use App\Models\TaskItem;
use App\Models\ProjectManager;
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
// factory(App\User::class, 20)->create()

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'users_id' =>function () {
            return factory(App\Models\ProjectManager::class)->create()->id;
        },
        'email' => $faker->unique()->safeEmail,
        'permission' => mt_rand(1, 100),
        'position' => mt_rand(1111, 999999),
        'status' => mt_rand(0, 2),
        'isAdmin' =>  0,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'updated_at' => now(),
        'created_at' => now()
    ];
});

// factory(App\Models\ModelsTask::class, 20)->create()
$factory->define(App\Models\ModelsTask::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->name,
        'content' => $faker->name,
        'status' => mt_rand(0, 2),
        'updated_at' => now(),
        'created_at' => now()
    ];
});
// factory(App\Models\ProjectManager::class, 10)->create()
$factory->define(App\Models\ProjectManager::class, function (Faker $faker) {
    return [
        'project_client' => $faker->name,
        'project_id' => mt_rand(0, 11111),
        'project_name' => $faker->name,
        'project_type' => $faker->name,
        'project_status' =>$faker->randomElement(['success', 'pending']),
        'date_start' => now(),
        'date_end' => now(),
        'updated_at' => now(),
        'created_at' => now()
    ];
});
// factory(App\Models\TaskItem::class, 20)->create()
$factory->define(App\Models\TaskItem::class, function (Faker $faker) {
    return [
        'taskid' => function () {
            return factory(App\Models\ModelsTask::class)->create()->id;
        },
        'taskname' => $faker->name,
        'created_at' => now(),
        'updated_at' => now()
    ];
});






