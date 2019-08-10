<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\TaskRepository;
use App\Task;

class TaskRepositoryEloquent implements TaskRepository
{
    public function whereSearch(string $search = null)
    {
        if (!$search) {
            return Task::all();
        }
        $tasks = Task::where('title', 'like', "%${search}%")
            ->get();

        return $tasks;
    }

    public function storeTask(array $data)
    {
        $task = new Task;
        $task->fill($data)->save();

        return $task;
    }
}
