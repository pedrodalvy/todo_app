<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'description',
        'start_date',
        'end_date',
        'task_list_id',
        'task_category_id',
        'completed',
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'completed_at',
        'created_at',
    ];

    public function taskList()
    {
        return $this->belongsTo(TaskList::class);
    }

    public function taskCategory()
    {
        return $this->belongsTo(TaskCategory::class);
    }
}
