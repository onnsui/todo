<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTask;
use App\Task;
use Illuminate\Http\Request;
use App\Repositories\Contracts\TaskRepository;
use Illuminate\Support\Collection;

class TaskController extends Controller
{
    /**
     * @var TaskRepository $taskRepository
     */
    private $taskRepository;

    /**
     * TaskController constructor.
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @param Request $request
     * @return Collection
     */
    public function index(request $request): Collection
    {
        $tasks = $this->taskRepository
            ->whereSearch($request->input('search'));

        return $tasks;
    }

    /**
     * @param CreateTask $request
     * @return Task
     */
    public function store(CreateTask $request): Task
    {
        $task = $this->taskRepository->storeTask($request->all());

        return $task;
    }
}
