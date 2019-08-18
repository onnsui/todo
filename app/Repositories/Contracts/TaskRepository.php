<?php

namespace App\Repositories\Contracts;

use App\Task;

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
     * @param array $data
     * @return Task
     */
    public function storeTask(array $data);
}
