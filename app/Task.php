<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title', 'content', 'due_date', 'status', 'category_id', 'user_id'
    ];
}
