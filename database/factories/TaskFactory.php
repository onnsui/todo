<?php

use App\Task;
use App\Category;
use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'title' => $faker->word,
        'content' => $faker->word,
        'due_date' => Carbon::tomorrow()->toDateTimeString(),
        'status' => array_rand(Task::STATUS_LIST),
    ];
});

$factory->afterCreating(Task::class, function (Task $task) {
    $tags = factory(Category::class, 3)->create();
    $task->categories()->sync($tags);
});
