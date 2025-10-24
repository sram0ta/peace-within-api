<?php

namespace App\Jobs;

use App\Models\Task;
use App\Notifications\TaskDueNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendTaskNotification implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(public int $taskId) {}

    public function handle(): void
    {
        $task = Task::with(['user', 'date'])->find($this->taskId);
        if (!$task || !$task->user) {
            return;
        }

        $task->user->notify(new TaskDueNotification($task));
    }
}
