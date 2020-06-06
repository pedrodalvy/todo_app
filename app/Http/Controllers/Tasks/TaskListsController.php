<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskListRequest as Request;
use App\Http\Resources\Tasks\TaskListResource;
use App\Http\Resources\Tasks\TaskListsCollection;
use App\Services\TaskListsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Mockery\Exception;

class TaskListsController extends Controller
{
    private $taskListsService;

    /**
     * TaskListsController constructor.
     *
     * @param TaskListsService $taskListsService
     */
    public function __construct(TaskListsService $taskListsService)
    {
        $this->taskListsService = $taskListsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        try {
            $taskLists = $this->taskListsService->getAllTaskLists();
            return new TaskListsCollection($taskLists);

        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'An error occurred while retrieving the list of tasks'
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return TaskListResource|JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $taskList = $this->taskListsService->storeTaskList($request);
            return new TaskListResource($taskList);

        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return TaskListResource|JsonResponse
     */
    public function show($id)
    {
        try {
            $taskList = $this->taskListsService->getTaskListById($id);
            return new TaskListResource($taskList);

        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return TaskListResource|JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $taskList = $this->taskListsService->updateTaskList($request, $id);
            return new TaskListResource($taskList);

        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse|Response
     */
    public function destroy($id)
    {
        try {
            $deletedTaskList = $this->taskListsService->destroyTaskList($id);
            return response()->json([
                'message' => $deletedTaskList
            ], 200);

        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
