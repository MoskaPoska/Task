<?php

namespace App\Http\Controllers;

use App\Models\Attachments;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        $request->validate([
            'file'=>'required|file|max:2048',
        ]);
        $file = $request->file('file');
        $path=$file->store('attachments');

        $task->attachments()->create([
            'file_path'=>$path,
            'file_name'=>$file->getClientOriginalName()
        ]);
        return redirect()->back()->with('success', 'Файл успішно додано');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task, Attachments $attachments)
    {
        $this->authorize('update', $task);
        Storage::delete($attachments->file_path);
        $attachments->delete();

        return redirect()->back()->with('success', 'Файл успішно видалено');
    }
}
