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
        $user = auth()->user();

        return TaskList::where('user_id', $user->id)
            ->paginate(TaskList::DEFAULT_PER_PAGE);
    }

    /**
     * @param $id
     * @return TaskList
     */
    public function getTaskListById($id)
    {
        return TaskList::where([
            'id' => $id,
            'user_id' => auth()->user()->id,
        ])->get()->first();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function storeTaskList(Request $request)
    {
        $data = array_merge($request->all(), ['user_id' => auth()->user()->id]);
        return TaskList::create($data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return bool
     */
    public function updateTaskList(Request $request, $id)
    {
        $taskList = TaskList::where([
            'id' => $id,
            'user_id' => auth()->user()->id,
        ])->get()->first();

        $taskList->fill($request->all())->save();

        return $taskList;
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroyTaskList($id)
    {
        $taskList = TaskList::where([
            'id' => $id,
            'user_id' => auth()->user()->id,
        ])->get()->first();

        return $taskList->delete();
    }
}