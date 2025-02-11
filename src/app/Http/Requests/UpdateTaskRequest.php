<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function store(StoreTaskRequest $request)
    {
        $validateDate = $request->validated();

        $task = Task::create($validateDate);
        return redirect()->route('tasks.index')->with('success', 'Завдання успішно створено');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $validateDate = $request->validated();
        $task->update($validateDate);
        return redirect()->route('tasks.index')->with('success', 'Завдання успішно оновлено');
    }
}
