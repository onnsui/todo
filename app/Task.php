<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    const STATUS_LIST = [
        '1' => 'work',
        '2' => 'private',
        '3' => 'other'
    ];

    protected $fillable = [
        'title',
        'content',
        'due_date',
        'status',
        'user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories() :BelongsToMany
    {
        return $this
            ->belongsToMany(Category::class, 'task_category_ref')
            ->withPivot('task_id', 'category_id')
            ->withTimestamps();
    }
}
