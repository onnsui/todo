<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTask;
use App\Task;
use App\Repositories\Contracts\TaskRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

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
        $userId = auth()->id();
        $task = $this->taskRepository->storeTask(collect($request->all()), $userId);

        return $task;
    }
}
