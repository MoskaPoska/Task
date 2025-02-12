@extends('layouts.app')
@section()
    <div class="container">
        <h1>Створити новий тег</h1>
        <form action="{{route('tags.store')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Назва тегу</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Створити</button>
        </form>
    </div>
@endsection
