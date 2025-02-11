<?php

use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('tasks')->group(function (){
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('{/task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::post('{/task}/comments', [TaskController::class, 'store'])->name('tasks.comments.store');
    Route::delete('/{task}/attachments/{attachments}', [TaskController::class, 'destroy'])->name('tasks.attachments.destroy');
});
Route::prefix('tasks/{task}/subtasks')->group(function (){
    Route::get('/', [SubtaskController::class, 'index'])->name('tasks.subtasks.index');
    Route::get('create', [SubtaskController::class, 'create'])->name('tasks.subtasks.create');
    Route::post('/', [SubtaskController::class, 'store'])->name('tasks.subtasks.store');
    Route::get('/{subtasks}', [SubtaskController::class, 'show'])->name('tasks.subtasks.show');
    Route::get('/{subtasks}/edit', [SubtaskController::class, 'edit'])->name('tasks.subtasks.edit');
    Route::put('/{subtask}', [SubtaskController::class, 'update'])->name('tasks.subtasks.update');
    Route::delete('/{subtasks}', [SubtaskController::class, 'destroy'])->name('tasks.subtasks.destroy');
});
Route::prefix('tags')->group(function (){
    Route::get('/', [TagController::class, 'index'])->name('tags.index');
    Route::get('/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('/', [TagController::class, 'store'])->name('tags.store');
    Route::get('/{tags}', [TagController::class, 'show'])->name('tags.show');
    Route::get('/{tags}/edit', [TagController::class, 'edit'])->name('tags.edit');
    Route::put('/{tags}', [TagController::class, 'update'])->name('tags.update');
    Route::delete('/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');
});





Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
