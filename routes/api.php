<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::prefix('v1')->group(function () {
    Route::apiResources([
        'task_lists' => 'Tasks\TaskListsController',
        'task_categories' => 'Tasks\TaskCategoriesController',
        'tasks' => 'Tasks\TasksController',
    ]);
});