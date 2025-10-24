<?php

namespace App\Observers;

use App\Jobs\SendTaskNotification;
use App\Models\Task;
use Carbon\CarbonImmutable;

class TaskObserver
{
    public function created(Task $task): void
    {
        $date = $task->date;
        if (!$date?->value) {
            return;
        }

        $when = CarbonImmutable::parse($date->value, 'Europe/Moscow');

        $delay = $when->diffInSeconds(now('Europe/Moscow'), false) * -1;
        if ($delay < 0) {
            $delay = 0;
        }

        SendTaskNotification::dispatch($task->id)->delay($delay);
    }
}
