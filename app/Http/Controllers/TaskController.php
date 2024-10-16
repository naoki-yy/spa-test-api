<?php

namespace App\Http\Controllers;

use App\Enums\TaskType;
use App\Http\UseCases\Task\TaskAction;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * タスク一覧の表示
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = Task::orderBy('deadline')->get();
        return response()->json($users);
    }

    public function checked(Task $task, TaskAction $action)
    {
        $result = $action->checked($task);

        return response()->json($result, 200);
    }
}
