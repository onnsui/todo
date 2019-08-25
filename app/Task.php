<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Task extends Model
{
    protected $fillable = [
        'title',
        'content',
        'due_date',
        'status',
        'category_id',
        'user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
