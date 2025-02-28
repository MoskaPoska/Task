<?php

namespace App\Http\Controllers;

use App\Models\Subtasks;
use App\Models\Task;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Task $task)
    {
        $this->authorize('view', $task);
        $subtasks = $task->subtasks;
        return view('subtasks.index', compact('task', 'subtasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Task $task)
    {
        $this->authorize('update', $task);
        return view('subtasks.create', compact('task'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        $request->validate([
            'title'=>'required|string|max:255',
        ]);
        $task->subtasks()->create([
            'title'=>$request->title,
        ]);
        return redirect()->route('tasks.subtasks.index', $task)->with('success', 'Підзавдання успішно створено');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task, Subtasks $subtasks)
    {
//        $this->authorize('view', $task);
        return view('subtasks.show', compact('task', 'subtasks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task, Subtasks $subtasks)
    {
//        $this->authorize('update', $task);
        return view('subtasks.edit', compact('task', 'subtasks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task, Subtasks $subtasks)
    {
//        $this->authorize('update', $task);

        $request -> validate([
            'title'=>'required|string|max:255'
        ]);
        $subtasks->update([
            'title'=>$request->title
        ]);
        return redirect()->route('tasks.subtasks.update', $task)->with('success','Підзавдання успішно оновлено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task, Subtasks $subtasks)
    {
//        $this->authorize('update', $task);
        $subtasks->delete();
        return redirect()->back('tasks.subtasks.index', $task)->with('success', 'Підзавдання успішно видалено');
    }
}
