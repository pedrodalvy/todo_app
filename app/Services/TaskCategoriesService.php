<?php

namespace App\Services;

use App\Models\TaskCategory;
use App\Http\Requests\TaskCategoryRequest as Request;

class TaskCategoriesService
{
    /**
     * @return TaskCategory[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllTaskCategories()
    {
        return TaskCategory::all();
    }

    /**
     * @param $id
     * @return TaskCategory
     */
    public function getTaskCategoryById($id)
    {
        return TaskCategory::findOrFail($id);
    }

    /**
     * @param Request $request
     * @return TaskCategory
     */
    public function storeTaskCategory(Request $request)
    {
        return TaskCategory::create($request->all());
    }

    /**
     * @param Request $request
     * @param $id
     * @return TaskCategory
     */
    public function updateTaskCategory(Request $request, $id)
    {
        $taskCategory = TaskCategory::findOrFail($id);
        $taskCategory->fill($request->all())->save();

        return $taskCategory;
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroyTaskCategory($id)
    {
        $taskCategory = TaskCategory::findOrFail($id);
        return $taskCategory->delete();
    }
}