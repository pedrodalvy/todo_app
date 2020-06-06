<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResources([
        'task_lists' => 'Tasks\TaskListsController',
        'task_categories' => 'Tasks\TaskCategoriesController',
        'tasks' => 'Tasks\TasksController',
    ]);
});