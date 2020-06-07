<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TaskCategory;
use Faker\Generator as Faker;

$factory->define(TaskCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'color' => $faker->safeHexColor,
        'user_id' => function () {
            $randomUser = \Illuminate\Support\Facades\DB::table('users')
                ->inRandomOrder()
                ->first();
            return $randomUser->id;
        }
    ];
});
