<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\TaskRepository;
use App\Task;

class TaskRepositoryEloquent implements TaskRepository
{

    public function whereSearch(string $search = null)
    {
        if (!$search) {
            return $this;
        }
        $tasks = Task::where('title', 'like', "%${search}%")
            ->get();

        return $tasks;
    }
}
