<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Events\TaskRealTimeUpdate;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskAssign;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $user = User::find($request->user_id);
        return TaskResource::collection($user->tasks);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $user = User::find($request->user_id);
        $task =  $user->tasks()->create($request->validated());
        // Fire the event
        $evetData = [
            "type" => 'create',
            "data" => $task,
        ];
        broadcast(new TaskRealTimeUpdate($evetData))->toOthers();
        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, $id)
    {
        $task = Task::find($id);
        $task->update($request->validated());
        $evetData = [
            "type" => 'update',
            "data" => $task,
        ];
        // Fire the event
        broadcast(new TaskRealTimeUpdate($evetData))->toOthers();
        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->noContent();
    }
    public function getAllUser(){
        return response()->json(User::all());
    }

    public function getAllTask(){
        return response()->json(Task::all());
    }

    public function assignTask(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'task_id' => 'required|exists:tasks,id',
            'assign_to' => 'required|exists:users,id',

        ]);

        $task = new TaskAssign();
        $task->assign_by = $request->user_id;
        $task->task_id = $request->task_id;
        $task->assign_to = $request->assign_to;
        $task->save();

        return response()->json(['message' => 'Task assigned successfully.']);
    }
}

