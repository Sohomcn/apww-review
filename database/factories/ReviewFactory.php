<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Models\Review\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        //'fan_id'            => User::where('usertype',3)->get()->random()->id,
        //'model_id'          => User::where('usertype',2)->get()->random()->id,

        'model_id'          => function () {
            return factory(App\User::class)->create(['usertype' => 2])->id;
        },

        'fan_id'          => function () {
            return factory(App\User::class)->create(['usertype' => 3])->id;
        },


        'title'             => $faker->sentence(),
        'body'              => $faker->paragraph(),
        'rating'            => $faker->randomElement([1, 2, 3, 4, 5])
    ];
});
