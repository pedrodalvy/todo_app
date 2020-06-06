<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->middleware('api')
    ->group(function () {
        Route::post('login', 'AuthController@login')->name('api.login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');

    });

Route::prefix('v1')->middleware(['auth:api', 'jwt.refresh'])
    ->group(function () {
        Route::apiResources([
            'task_lists' => 'Tasks\TaskListsController',
            'task_categories' => 'Tasks\TaskCategoriesController',
            'tasks' => 'Tasks\TasksController',
        ]);
    });
