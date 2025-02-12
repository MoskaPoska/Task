@extends('layouts.app')
@section()
    <div class="container">
        <h1>Редагування завдання</h1>
        <form action="{{route('tasks.update', $task)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Назва</label>
                <input type="text" name="title" id="title" class="form-control" value="{{$task->title}}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Опис</label>
                <textarea name="description" id="description" class="form-control">value="{{$task->description}}"</textarea>
            </div>
            <div class="mb-3">
                <label for="priority" class="form-label">Пріоритет</label>
                <select name="priority" id="priority" class="form-control" required>
                    <option value="low" {{$task->priority==='low'?'selected':''}}>Низький</option>
                    <option value="medium" {{$task->priority==='medium'?'selected':''}}>Середній</option>
                    <option value="high" {{$task->priority==='high'?'selected':''}}>Високий</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="due_date" class="form-label">Дата завершення</label>
                <input type="date" name="due_date" id="due_date" class="form-control" value="{{$task->due_date}}">
            </div>
            <div>
                <label for="tags" class="form-label">Теги</label>
                <select name="tags[]" id="tags" class="form-control" multiple>
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}}" {{$task->tags->contains($tag->id)? 'selected':''}} >{{$tag->name}}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Оновити</button>
        </form>
    </div>
@endsection
