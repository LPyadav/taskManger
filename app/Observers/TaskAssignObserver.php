<?php

namespace App\Observers;

use App\Models\TaskAssign;

use App\Models\User;
use App\Models\Task;
use App\Jobs\SendTaskNotification;
use App\Notifications\TaskAssigned;
use Illuminate\Support\Facades\Log;

class TaskAssignObserver
{
    /**
     * Handle the TaskAssign "created" event.
     */
    public function created(TaskAssign $taskAssign): void
    {
        //Log::log("Observer",[$taskAssign]);
        SendTaskNotification::dispatch($taskAssign);
    }

    /**
     * Handle the TaskAssign "updated" event.
     */
    public function updated(TaskAssign $taskAssign): void
    {
        if ($taskAssign->isDirty('assign_to')) {
            SendTaskNotification::dispatch($taskAssign);
        }
    }

    /**
     * Handle the TaskAssign "deleted" event.
     */
    public function deleted(TaskAssign $taskAssign): void
    {
        //
    }

    /**
     * Handle the TaskAssign "restored" event.
     */
    public function restored(TaskAssign $taskAssign): void
    {
        //
    }

    /**
     * Handle the TaskAssign "force deleted" event.
     */
    public function forceDeleted(TaskAssign $taskAssign): void
    {
        //
    }

}
