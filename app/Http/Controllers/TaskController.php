<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

use App\Models\Project;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $tasks = $request->user()->tasks;

    return response()->json($tasks);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'nullable|string',
        'due_date' => 'nullable|date',
        'project_id' => 'nullable|exists:projects,id',
    ]);

    if (isset($validated['project_id'])) {
        $project = Project::find($validated['project_id']);

        if ($project->user_id !== $request->user()->id) {
            return response()->json(['message' => 'غير مسموح لك بهاد الإجراء'], 403);
        }
    }

    $validated['user_id'] = $request->user()->id;

    $task = Task::create($validated);

    return response()->json($task, 201);
}
    /**
     * Display the specified resource.
     */
    public function show(Request $request, Task $task)
{
    if ($task->user_id !== $request->user()->id) {
        return response()->json(['message' => 'غير مسموح لك بهاد الإجراء'], 403);
    }

    return response()->json($task);
}
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
{
    if ($task->user_id !== $request->user()->id) {
        return response()->json(['message' => 'غير مسموح لك بهاد الإجراء'], 403);
    }

    $validated = $request->validate([
        'title' => 'sometimes|required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'nullable|string',
        'due_date' => 'nullable|date',
    ]);

    $task->update($validated);

    return response()->json($task);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Task $task)
{
    if ($task->user_id !== $request->user()->id) {
        return response()->json(['message' => 'غير مسموح لك بهاد الإجراء'], 403);
    }

    $task->delete();

    return response()->json(['message' => 'تم حذف المهمة بنجاح']);
}
}
