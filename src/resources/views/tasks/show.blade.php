@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{$task->title}}</h1>
        <p>{{$task->description}}</p>
        <small>Пріоритет: {{$task->priority}}, Дата завршення: {{$task->due_date}}</small>
{{--        <h3>Підзавдання</h3>--}}
        <ul>
            @foreach($task->subtasks as $subtask)
                <li>{{$subtask->title}}</li>
            @endforeach
        </ul>
        <h3>Коментарі</h3>
        <ul>
            @foreach($task->comments as $comment)
                <li>
{{--                    {{$comment->user->name}}--}}
                    {{$comment->content}}
                </li>
            @endforeach
        </ul>
        <h3>Файли</h3>
        <ul>
            @foreach($task->attachments as $attachment)
                <li>
                    <a href="{{Storage::url($attachment->file_path)}}" target="_blank">{{$attachment->file_name}}</a>
                </li>
            @endforeach
        </ul>
        <a href="{{route('tasks.index', $task)}}" class="btn btn-warning">Перейти на головну</a>
        <form action="{{route('tasks.destroy', $task)}}" method="POST" class="g-line">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Видалити</button>
        </form>

        <h3 class="mt-4">Додати коментар</h3>
        <form action="{{ route('tasks.comments.store', $task) }}" method="POST">
            @csrf
            <div class="mb-3">
                <textarea name="content" class="form-control" placeholder="Ваш коментар" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Додати коментар</button>
        </form>

        <h3 class="mt-4">Додати файл</h3>
        <form action="{{ route('tasks.attachments.store', $task) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="file" name="file" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Додати файл</button>
        </form>
    </div>
@endsection
