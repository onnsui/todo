<?php

use App\Task;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'content' => $faker->word,
        'due_date' => $faker->dateTime,
        'status' => $faker->randomDigit,
        'category_id'  => function () {
            return factory(Category::class)->create()->id;
        },
//        'category_id' => $faker->randomElement(array_keys(config('master.category'))),
    ];
});
