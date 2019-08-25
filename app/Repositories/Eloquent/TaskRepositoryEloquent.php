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
     * @param int $userId
     * @param Collection $data
     * @return Task
     */
    public function storeTask(Collection $data, int $userId)
    {
        $param = $data->merge(['user_id' => $userId]);
        return Task::create($param->all());
    }
}
