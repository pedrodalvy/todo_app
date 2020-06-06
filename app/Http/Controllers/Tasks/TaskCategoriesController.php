<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskCategoryRequest as Request;
use App\Http\Resources\Tasks\TaskCategoriesCollection;
use App\Http\Resources\Tasks\TaskCategoryResource;
use App\Services\TaskCategoriesService;
use Exception;
use Illuminate\Http\JsonResponse;

class TaskCategoriesController extends Controller
{
    private $taskCategoriesService;

    public function __construct(TaskCategoriesService $taskCategoriesService)
    {
        $this->taskCategoriesService = $taskCategoriesService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return TaskCategoriesCollection|JsonResponse
     */
    public function index()
    {
        try {
            $taskCategories = $this->taskCategoriesService->getAllTaskCategories();
            return new TaskCategoriesCollection($taskCategories);

        } catch (Exception $exception) {
            return response()->json([
                'message' => 'An error occurred while retrieving the task categories'
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return TaskCategoryResource|JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $taskCategory = $this->taskCategoriesService->storeTaskCategory($request);
            return new TaskCategoryResource($taskCategory);

        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return TaskCategoryResource|JsonResponse
     */
    public function show($id)
    {
        try {
            $taskCategory = $this->taskCategoriesService->getTaskCategoryById($id);
            return new TaskCategoryResource($taskCategory);

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
     * @param int $id
     * @return TaskCategoryResource|JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $taskCategory = $this->taskCategoriesService->updateTaskCategory($request, $id);
            return new TaskCategoryResource($taskCategory);

        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            $deletedTaskCategory = $this->taskCategoriesService->destroyTaskCategory($id);
            return response()->json([
                'message' => $deletedTaskCategory
            ], 200);

        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
