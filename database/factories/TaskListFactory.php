<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TaskList;
use Faker\Generator as Faker;

$factory->define(TaskList::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'user_id' => function () {
            $randomUser = \Illuminate\Support\Facades\DB::table('users')
                ->inRandomOrder()
                ->first();
            return $randomUser->id;
        }
    ];
});
