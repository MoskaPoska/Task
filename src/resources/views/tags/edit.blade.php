@extends('layouts.app')
@section()
    <div class="container">
        <h1>Редагувати тег</h1>
        <form action="{{route('tags.update', $tag)}}" method="POST">
            @csrf
            @method("PUT")
            <div class="mb-3">
                <label for="name" class="form-label">Назва тегу</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$tag->name}}" required>
            </div>
            <button type="submit" class="btn btn-primary">Оновити</button>
        </form>
    </div>
@endsection
