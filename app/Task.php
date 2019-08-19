<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    const STATUS_LIST = [
        '1' => 'work',
        '2' => 'private',
        '3' => 'other'
    ];
  
    protected $fillable = [
        'title', 'content', 'due_date', 'status', 'category_id'
    ];
}
