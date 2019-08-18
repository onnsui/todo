<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\TaskRepository;
use App\Task;

class TaskRepositoryEloquent implements TaskRepository
{
    /**
     * @param string $search
     * @return Task
     */
    public function whereSearch(string $search = null)
    {
        if (!$search) {
            return Task::all();
        }
        $tasks = Task::where('title', 'like', "%${search}%")
            ->get();

        return $tasks;
    }

    /**
     * @param array $data
     * @return Task
     */
    public function storeTask(array $data)
    {
        $task = new Task;
        $task->fill($data)->save();

        return $task;
    }
}
