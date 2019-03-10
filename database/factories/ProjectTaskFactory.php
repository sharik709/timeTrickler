<?php

use App\Project;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\ProjectTask::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->sentences(3, true),
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'task_number' => rand(1, 999),
        'due_date' => $faker->date(),
        'project_id' => function() {
            return factory(Project::class)->create()->id;
        }
    ];
});
