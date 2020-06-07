<?php

use Illuminate\Database\Seeder;

class TaskListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\TaskList::class, 25)->create()->each(function ($taskList) {
            $numbersOfTasks = rand(0, 10);
            for($i = 0; $i < $numbersOfTasks; $i++)
                $taskList->tasks()->save(factory(\App\Models\Task::class)->make());
        });
    }
}
