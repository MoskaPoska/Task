@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Мої завдання</h1>
        <a href="{{route('tasks.create')}}" class="btn btn-primary mb-3">Створити завдання</a>
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        <div class="list-group">
            @foreach($tasks as $task)
                <div class="list-group-item">
                    <h2>{{$task->title}}}</h2>
                    <p>{{$task->description}}}</p>
                    <small>Пріорітет: {{$task->priority}}, Дата завершення: {{$task->due_date}}}</small>
                    <div class="mt-2">
                        <a href="{{route('tasks.show', $task)}}" class="btn btn-info btn-sm">Переглянути</a>
                        <a href="{{route('tasks.edit', $task)}}" class="btn btn-warning btn-sm">Редагувати</a>
                        <form action="{{route('tasks.destroy', $task)}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Видалити</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
