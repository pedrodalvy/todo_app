<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest as Request;
use App\Http\Resources\Tasks\TaskResource;
use App\Http\Resources\Tasks\TasksCollection;
use App\Services\TasksService;
use Exception;
use Illuminate\Http\JsonResponse;

class TasksController extends Controller
{
    private $tasksService;

    /**
     * TasksController constructor.
     *
     * @param TasksService $tasksService
     */
    public function __construct(TasksService $tasksService)
    {
        $this->tasksService = $tasksService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return TasksCollection|JsonResponse
     */
    public function index()
    {
        try {
            $tasks = $this->tasksService->getAllTasks();
            return new TasksCollection($tasks);

        } catch (Exception $exception) {
            return response()->json([
                'message' => 'An error occurred while retrieving the tasks'
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return TaskResource|JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $task = $this->tasksService->storeTask($request);
            return new TaskResource($task);

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
     * @return TaskResource|JsonResponse
     */
    public function show($id)
    {
        try {
            $task = $this->tasksService->getTaskById($id);
            return new TaskResource($task);

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
     * @return TaskResource|JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $task = $this->tasksService->updateTask($request, $id);
            return new TaskResource($task);

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
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            $deletedTask = $this->tasksService->destryTask($id);
            return response()->json([
                'message' => $deletedTask
            ], 200);

        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
