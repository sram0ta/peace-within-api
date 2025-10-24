<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TaskDueNotification extends Notification
{
    use Queueable;

    public function __construct(public Task $task) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'task_id' => $this->task->id,
            'title'   => $this->task->title,
            'repeat'  => (bool)$this->task->repeat,
            'date_id' => $this->task->date_id,
        ];
    }
}
