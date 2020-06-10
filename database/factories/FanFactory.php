<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Users;
use Faker\Generator as Faker;

$factory->define(Users::class, function (Faker $faker) {
    return [
        'name'              => $faker->name,
        'usertype'          => 3,
        'email'             => $faker->unique()->safeEmail,
        'password'          => '$2y$10$fOvUwwN50jGkKd.3.ZTJw.MkHunfAksk1X.8z0LSzi6xOBQT9U4Om',
    ];
});
