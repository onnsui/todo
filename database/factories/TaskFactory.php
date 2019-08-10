<?php

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'content' => $faker->word,
        'due_date' => $faker->dateTime,
        'status' => $faker->randomDigit,
        'category_id' => $faker->randomDigit
    ];
});
