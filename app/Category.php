<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $fillable = [
        'title',
        'user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tasks() :BelongsToMany
    {
        return $this
            ->belongsToMany(Task::class, 'task_category_ref')
            ->withPivot('task_id', 'category_id')
            ->withTimestamps();
    }
}
