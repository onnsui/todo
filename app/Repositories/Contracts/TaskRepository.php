<?php

namespace App\Repositories\Contracts;

use App\Task;
use Illuminate\Support\Collection;

/**
 * Interface TaskRepository
 *
 * @package namespace App\Repositories\Contracts;
 */
interface TaskRepository
{

    /**
     * フリーワード検索をする
     * 検索フィールドはid,sei,mei,email
     *
     * @param string $search
     * @return Task
     */
    public function whereSearch(string $search = null);

    /**
     * タスクを作成する
     *
     * @param Collection $data
     * @param int $userId
     * @return Task
     */
    public function storeTask(Collection $data, int $userId);

    /**
     * タスクを編集する
     *
     * @param Collection $data
     * @param int $userId
     * @param Task $task
     * @return Task
     */
    public function updateTask(Collection $data, int $userId, Task $task);

    /**
     * タスクをID検索する
     *
     * @param int $taskId
     * @return Task
     */
    public function find(int $taskId);
}
