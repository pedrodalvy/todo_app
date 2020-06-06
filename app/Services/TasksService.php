<?php

namespace App\Services;

use App\Models\Task;
use App\Http\Requests\TaskRequest as Request;
use App\Models\TaskList;

class TasksService
{
    /**
     * @param $taskListId
     * @return Task[]
     */
    public function getAllTasksByTaskList($taskListId)
    {
        $taskList = TaskList::where([
            'id' => $taskListId,
            'user_id' => auth()->user()->id
        ])->get()->first();

        return $taskList->tasks()->paginate(Task::DEFAULT_PER_PAGE);
    }

    /**
     * @param $id
     * @return Task
     */
    public function getTaskById($id)
    {
        return Task::findOrFail($id);
    }

    /**
     * @param Request $request
     * @return Task
     */
    public function storeTask(Request $request)
    {
        return Task::create($request->all());
    }

    /**
     * @param Request $request
     * @param $id
     * @return Task
     */
    public function updateTask(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->fill($request->all())->save();
        return $task;
    }

    /**
     * @param $id
     * @return bool
     */
    public function destryTask($id)
    {
        $task = Task::findOrFail($id);
        return $task->delete();
    }
}