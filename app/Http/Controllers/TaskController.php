<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTask;
use App\Task;
use App\Repositories\Contracts\TaskRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

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
        $data = $request->validated();
        $task = $this->taskRepository->storeTask(collect($data), $userId);
        $task->categories()->attach($request->category_ids);

        return $task;
    }

    /**
     * @param CreateTask $request
     * @param int $taskId
     * @return Task
     */
    public function update(CreateTask $request, int $taskId): Task
    {
        $userId = auth()->id();
        $data = $request->validated();
        $task = $this->taskRepository->find($taskId);

        if ($userId !== $task->user_id) {
            throw new AccessDeniedHttpException('access forbidden.');
        }

        $taskData = $this->taskRepository->updateTask(collect($data), $userId, $task);
        $taskData->categories()->delete();
        $taskData->categories()->attach($request->category_ids);

        return $task;
    }
}
