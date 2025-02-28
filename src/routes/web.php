<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('tasks', TaskController::class);
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('create', [TaskController::class, 'create'])->name('tasks.create');
    Route::get('/tasks/search', [TaskController::class, 'search'])->name('tasks.search');
    Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::post('/{task}/comments', [TaskController::class, 'addComment'])->name('tasks.comments.store');
    Route::post('/{task}/attachments', [TaskController::class, 'addAttachment'])->name('tasks.attachments.store');
    Route::delete('/{tasks}/attachments/{attachment}', [TaskController::class, 'destroyAttachment'])->name('tasks.attachments.destroy');
});
//Route::prefix('tasks/{task}/subtasks')->group(function (){
//    Route::get('/', [SubtaskController::class, 'index'])->name('tasks.subtasks.index');
//    Route::get('create', [SubtaskController::class, 'create'])->name('tasks.subtasks.create');
//    Route::post('/', [SubtaskController::class, 'store'])->name('tasks.subtasks.store');
//    Route::get('/{subtasks}', [SubtaskController::class, 'show'])->name('tasks.subtasks.show');
//    Route::get('/{subtasks}/edit', [SubtaskController::class, 'edit'])->name('tasks.subtasks.edit');
//    Route::put('/{subtask}', [SubtaskController::class, 'update'])->name('tasks.subtasks.update');
//    Route::delete('/{subtasks}', [SubtaskController::class, 'destroy'])->name('tasks.subtasks.destroy');
//});
Route::prefix('tags')->group(function (){
    Route::get('/', [TagController::class, 'index'])->name('tags.index');
    Route::get('/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('/', [TagController::class, 'store'])->name('tags.store');
    Route::get('/{tags}', [TagController::class, 'show'])->name('tags.show');
    Route::get('/{tags}/edit', [TagController::class, 'edit'])->name('tags.edit');
    Route::put('/{tags}', [TagController::class, 'update'])->name('tags.update');
    Route::delete('/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');
});
require __DIR__.'/auth.php';
