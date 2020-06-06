<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    public const DEFAULT_PER_PAGE = 10;

    protected $fillable = [
        'description',
        'start_date',
        'end_date',
        'task_list_id',
        'task_category_id',
    ];

    protected $dates = [
        'start_date',
        'end_date'
    ];

    public function task()
    {
        return $this->belongsTo(TaskList::class);
    }

    public function category()
    {
        return $this->belongsTo(TaskCategory::class);
    }
}
