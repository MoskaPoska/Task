@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Створити нове завдання</h1>
        <form action="{{route('tasks.store')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Назва</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label"></label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="priority" class="form-label">Пріоритет</label>
                <select name="priority" id="priority" class="form-control" required>
                    <option value="low">Низький</option>
                    <option value="medium">Середній</option>
                    <option value="high">Високий</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="due_date" class="form-label">Дата завершення</label>
                <input type="date" name="due_date" id="due_date" class="form-control">
            </div>
            <div class="mb-3">
                <label for="tags" class="form-label">Теги</label>
                <select name="tags[]" id="tags" class="form-control" multiple>
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}}">{{$tag->name}}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Створити</button>
        </form>
    </div>
@endsection
