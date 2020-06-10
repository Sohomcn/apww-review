<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
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
        'name'              => $faker->name,
        'usertype'          => $faker->randomElement([2,3]),
        'email'             => $faker->unique()->safeEmail,
        'password'          => '$2y$10$fOvUwwN50jGkKd.3.ZTJw.MkHunfAksk1X.8z0LSzi6xOBQT9U4Om',
    ];
});
