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
    ];
});

$factory->afterCreating(Task::class, function ($task) {
    factory(Category::class)->create([
        'category_id' => $task->category_id,
    ]);
});
