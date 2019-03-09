<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Team::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->sentences(3, true),
        'user_id' => function(){
            return factory(User::class)->create()->id;
        },
        'users_limit' => 3
    ];
});
