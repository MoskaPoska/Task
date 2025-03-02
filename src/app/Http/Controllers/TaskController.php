<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTaskRequest;
use App\Models\Tags;
use App\Models\Task;
use Illuminate\Container\Attributes\Tag;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->with(['attachments', 'comments', 'tags'])
            ->get();

        return view('tasks.index', compact('tasks'));
    }
    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $tasks = Task::where('user_id', auth()->id())
                ->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%$search%")
                        ->orWhereHas('tags', function ($query) use ($search) {
                            $query->where('name', 'like', "%$search%");
                        });
                })
                ->with(['attachments', 'comments', 'tags'])
                ->orderByRaw("CASE WHEN title = ? THEN 0 ELSE 1 END", [$search])
                ->get();
        } else {
            $tasks = Task::where('user_id', auth()->id())
                ->with(['attachments', 'comments', 'tags'])
                ->get();
        }

        return view('tasks.index', compact('tasks', 'search'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tags::all();
        return view('tasks.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {

        $validatedData = $request->validated();


        $task = Task::create([
            'user_id' => auth()->id(),
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'priority' => $validatedData['priority'],
            'due_date' => $validatedData['due_date'],
        ]);


        if ($request->has('tags')) {
            $task->tags()->attach($request->tags);
        }

        return redirect()->route('tasks.index')->with('success', 'Завдання успішно створено');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
//        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
//        $this->authorize('update', $task);
        $tags = Tags::all();
        return view('tasks.edit', compact('task', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
//        $this->authorize('update', $task);


        $validatedData = $request->validated();


        $task->update([
            'title' => $validatedData['title']?? $task->title,
            'description' => $validatedData['description']?? $task->description,
            'priority' => $validatedData['priority']?? $task->priority,
            'due_date' => $validatedData['due_date']?? $task->due_date,
        ]);


        if ($request->has('tags')) {
            $task->tags()->sync($request->tags);
        } else {
            $task->tags()->detach();
        }

        return redirect()->route('tasks.index')->with('success', 'Завдання успішно оновлено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
//        $this->authorize('update', $task);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Завдання успішно видалено');
    }
    public function addSubtask(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        $request->validate([
            'title'=>$request->title
        ]);
        return redirect()->back()->with('success', 'Завдання успішно додано');
    }
    public function addComment(Request $request, Task $task)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $content = $request->input('content'); // Получаем значение из запроса

        $task->comments()->create([
            'user_id' => auth()->id(),
            'content' => $content, // Используем полученное значение $content
        ]);

        return redirect()->back()->with('success', 'Коментар успішно додано!');
    }
    public function addAttachment(Request $request, Task $task)
    {

//        $this->authorize('view', $task);


        $request->validate([
            'file' => 'required|file|max:2048',
        ]);


        $file = $request->file('file');
        $path = $file->store('attachments');

        // Создаем запись о вложении
        $task->attachments()->create([
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
        ]);

        return redirect()->back()->with('success', 'Файл успішно додано!');
    }
}
