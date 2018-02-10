<?php



$factory->define(App\models\User::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => Illuminate\Support\Facades\Hash::make('pass'),
        'city' => $faker->city,
        'status' => rand(1,0),




    ];
});
