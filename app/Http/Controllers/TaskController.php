<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\TaskRepository;
use Illuminate\Http\Request;

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

    public function index(Request $request) {
        $tasks = $this->taskRepository
            ->whereSearch($request);

        return $tasks;
    }
}
