<?php

namespace App\Http\UseCases\Task;

use App\Enums\TaskType;
use App\Models\Task;

class TaskAction
{
    /**
     * タスクのチェック
     *
     * @param Task $task
     * @return array<string, string>|boolean
     */
    public function checked(Task $task): array|bool
    {
        if ($task->check === TaskType::Unchecked->value) {
            $task->check = TaskType::Checked->value;
            $task->save();

            return ['task_name' => $task->name];
        } else {
            return false;
        }
    }
}
