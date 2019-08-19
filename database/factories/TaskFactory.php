<?php

use App\Task;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'content' => $faker->word,
        'due_date' => $faker->dateTime,
        'status' => array_rand(Task::STATUS_LIST),
        'category_id'  => function () {
            return factory(Category::class)->create()->id;
        },
    ];
});
