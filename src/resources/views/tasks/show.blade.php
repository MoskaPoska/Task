@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{$task->title}}</h1>
        <p>{{$task->description}}}</p>
        <small>Пріоритет: {{$task->priority}}, Дата завршення: {{$task->due_date}}</small>
        <h3>Підзавдання</h3>
        <ul>
            @foreach($task->subtasks as $subtask)
                <li>{{$subtask->title}}</li>
            @endforeach
        </ul>
        <h3>Коментарі</h3>
        <ul>
            @foreach($task->comments as $comment)
                <li>
                    {{$comment->user->name}}
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
        <a href="{{route('task.edit', $task)}}" class="btn btn-warning">Редагувати</a>
        <form action="{{route('task.destroy', $task)}}" method="POST" class="g-line">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Видалити</button>
        </form>
    </div>
@endsection
