<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\TaskRepository;
use App\Task;

class TaskRepositoryEloquent implements TaskRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Task::class;
    }

    public function whereSearch(string $search = null)
    {
        if (!$search) {
            return $this;
        }
        $tasks = Task::where('title', 'like', "%${search}%")
            ->get();

        return $tasks;
    }

    public function storeTask(array $data)
    {
        $task = new Task;
        $task->title = $data['title'];
        $task->content = $data['content'];
        $task->due_date = $data['due_date'];
        $task->status = $data['status'];
        $task->category_id = $data['category_id'];

        $task->save();

        return $task;
    }
}
