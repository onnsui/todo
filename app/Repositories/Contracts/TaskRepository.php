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
     * @param int $userId
     * @param Collection $data
     * @return Task
     */
    public function storeTask(Collection $data, int $userId);
}
