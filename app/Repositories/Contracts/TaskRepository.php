<?php

namespace App\Repositories\Contracts;

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
     * @return self
     */
    public function whereSearch(string $search = null);

    /**
     * タスクを作成する
     *
     * @param array $data
     * @return self
     */
    public function storeTask(array $data);
}
