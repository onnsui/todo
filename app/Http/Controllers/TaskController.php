<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTask;
use App\Task;
use Illuminate\Http\Request;
use App\Repositories\Contracts\TaskRepository;

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
     * @return Task
     */
    public function index(request $request)
    {
        $tasks = $this->taskRepository
            ->whereSearch($request->input('search'));

        return $tasks;
    }

    /**
     * @param CreateTask $request
     * @return Task
     */
    public function store(CreateTask $request)
    {
        $task = $this->taskRepository->storeTask($request->all());

        return $task;
    }
}
