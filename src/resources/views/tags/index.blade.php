@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Теги</h1>
        <a href="{{route('tags.create')}}" class="btn btn-primary mb-3">Створити тег</a>
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        <div class="list-group">
            @foreach($tags as $tag)
                <div class="list-group-item">
                    <h2>{{$tag->name}}</h2>
                    <div class="mt-2">
                        <a href="{{route('tags.edit', $tag)}}" class="btn btn-warning btn-sm">Редагувати</a>
                        <form action="{{route('tags.destroy', $tag)}}" method="POST" class="d-inline">
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
