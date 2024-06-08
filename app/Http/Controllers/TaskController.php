<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskAssign;
use Illuminate\Validation\Rule;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = auth()->user()->tasks;
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required|min:10',
            'status' => [
                'required',
                Rule::in(['pending', 'completed']), // Only allow 'pending' or 'completed' status
            ],
        ]);

        auth()->user()->tasks()->create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {

        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required|min:10',
            'status' => [
                'required',
                Rule::in(['pending', 'completed']), // Only allow 'pending' or 'completed' status
            ],
        ]);
        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }

}