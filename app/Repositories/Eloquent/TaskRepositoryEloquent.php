<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\TaskRepository;
use DB;

class TaskRepositoryEloquent implements TaskRepository
{
    protected $table = 'tasks';

    public function whereSearch(string $search = null)
    {
        return DB::table($this->table)->get();
    }
}
