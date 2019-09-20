<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\TaskRepository;
use App\Task;
use Illuminate\Support\Collection;

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
     * @param Collection $data
     * @param int $userId
     * @return Task
     */
    public function storeTask(Collection $data, int $userId)
    {
        $param = $data->merge(['user_id' => $userId]);
        return Task::create($param->all());
    }

    /**
     * @param Collection $data
     * @param int $userId
     * @param Task $task
     * @return Task
     */
    public function updateTask(Collection $data, int $userId, Task $task)
    {
        \DB::transaction(function () use ($task, $data) {
            $task->fill($data->toArray())->save();
        });
        return $task;
    }

    /**
     * @param int $taskId
     * @return Task
     */
    public function find(int $taskId)
    {
        $task = Task::findOrFail($taskId);
        return $task;
    }
}
