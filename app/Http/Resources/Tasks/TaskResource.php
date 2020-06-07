<?php

namespace App\Http\Resources\Tasks;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'category' => $this->getTaskCategory($this->taskCategory),
            'task_list' => $this->getTaskList($this->taskList),
        ];
    }

    private function getTaskCategory($taskCategory)
    {
        return new TaskCategoryResource($taskCategory);
    }

    private function getTaskList($taskList)
    {
        return new TaskListResource($taskList);
    }
}
