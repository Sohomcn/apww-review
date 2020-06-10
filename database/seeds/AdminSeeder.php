<?php

use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        User::create([
            'name'      =>  $faker->name,
            'usertype'  =>  1,
            'email'     =>  'admin@admin.com',
            'password'  =>  bcrypt('1234567890'),
        ]);
    }
}
