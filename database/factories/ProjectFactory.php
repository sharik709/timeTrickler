<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->sentence,
        'status' => (['active', 'inactive'])[rand(0, 1)],
        'user_id' => function(){
            return factory(User::class)->create()->id;
        }
    ];
});
