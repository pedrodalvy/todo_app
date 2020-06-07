<?php

namespace App\Http\Resources\Tasks;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TasksCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (Task $task) {
            return (new TaskResource($task));
        });

        return parent::toArray($request);
    }
}
