<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence,
        'start_date' => array_rand([0, 1]) === 1 ? $faker->dateTime : null,
        'end_date' => array_rand([0, 1]) === 1 ? $faker->dateTime : null,
        'completed' => array_rand([0, 1, 2, 3]) === 0 ? 1 : 0,
        'task_list_id' => function () {
            $randomTaskList = \Illuminate\Support\Facades\DB::table('task_lists')
                ->orderByDesc('id')
                ->first();
            return $randomTaskList->id;
        },
        'task_category_id' => function () {
            $randomCategory = \Illuminate\Support\Facades\DB::table('task_categories')
                ->inRandomOrder()
                ->first();
            return $randomCategory->id;
        },

    ];
});
