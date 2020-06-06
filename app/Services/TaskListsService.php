<?php

namespace App\Services;

use App\Http\Requests\TaskListRequest as Request;
use App\Models\TaskList;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class TaskListsService
{
    /**
     * @return TaskList[]|Collection
     */
    public function getAllTaskLists()
    {
        return TaskList::paginate(TaskList::DEFAULT_PER_PAGE);
    }

    /**
     * @param $id
     * @return TaskList
     */
    public function getTaskListById($id)
    {
        return TaskList::findOrFail($id);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function storeTaskList(Request $request)
    {
        return TaskList::create($request->all());
    }

    /**
     * @param Request $request
     * @param $id
     * @return bool
     */
    public function updateTaskList(Request $request, $id)
    {
        $taskList = TaskList::find($id);
        $taskList->fill($request->all())->save();
        return $taskList;
    }

    /**
     * @param $id
     * @return bool|null
     */
    public function destroyTaskList($id)
    {
        $taskList = TaskList::find($id);
        return $taskList->delete();
    }
}