<?php

namespace App\Http\Controllers;

use App\Enums\TaskType;
use App\Http\UseCases\Task\TaskAction;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * タスク一覧の表示
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $user = Auth::user();  // 現在のユーザーを取得

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);  // 未認証の応答
        }
        $tasks = Task::orderBy('deadline')->get();
        return response()->json($tasks);
    }

    /**
     * タスクチェック
     *
     * @param Task $task
     * @param TaskAction $action
     * @return void
     */
    public function checked(Task $task, TaskAction $action)
    {
        $result = $action->checked($task);

        return response()->json($result, 200);
    }

    public function add(Request $request)
    {
        $task = new Task();
        $task->user_id = Auth::user()->id;
        $task->name = $request->name;
        $task->detail = $request->detail;
        $task->deadline = $request->deadLine;
        $task->check = TaskType::Unchecked;
        $task->save();

        return response()->json(200);
    }
}
