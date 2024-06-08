<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Task;
use App\Models\TaskAssign;
use App\Models\User;
use App\Notifications\TaskAssigned;

class SendTaskNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $task;


    /**
     * Create a new job instance.
     */
    public function __construct(TaskAssign $task)
    {

        $this->task = $task;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
    
        $user = User::find($this->task->assign_to);
        $task = Task::find($this->task->task_id);
        $user->notify(new TaskAssigned( $task ));
    }
}
