@extends('layouts.app')
@section()
    <div class="container">
        <h1>Редагування завдання</h1>
        <form action="{{route('tasks.update', $task)}}" method="POST">

        </form>
    </div>
@endsection
