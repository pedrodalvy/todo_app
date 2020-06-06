<?php

namespace App\Services;

use App\Http\Requests\TaskCategoryRequest as Request;
use App\Models\TaskCategory;

class TaskCategoriesService
{
    /**
     * @return TaskCategory[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllTaskCategories()
    {
        $user = auth()->user();

        return TaskCategory::where('user_id', $user->id)->get();
    }

    /**
     * @param $id
     * @return TaskCategory
     */
    public function getTaskCategoryById($id)
    {
        return TaskCategory::where([
            'id' => $id,
            'user_id' => auth()->user()->id,
        ])->get()->first();
    }

    /**
     * @param Request $request
     * @return TaskCategory
     */
    public function storeTaskCategory(Request $request)
    {
        return TaskCategory::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return TaskCategory
     */
    public function updateTaskCategory(Request $request, $id)
    {
        $taskCategory = TaskCategory::where([
            'id' => $id,
            'user_id' => auth()->user()->id,
        ])->get()->first();

        $taskCategory->fill($request->all())->save();

        return $taskCategory;
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroyTaskCategory($id)
    {
        $taskCategory = TaskCategory::where([
            'id' => $id,
            'user_id' => auth()->user()->id,
        ])->get()->first();

        return $taskCategory->delete();
    }
}