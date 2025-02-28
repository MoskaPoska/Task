@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">Мої завдання</h1>

        <footer class="footer mt-auto py-3 ">
            <div class="container">
                <form action="{{ route('tasks.search') }}" method="GET" class="float-end">
                    <input type="text" name="search" class="form-control me-2" placeholder="Пошук" value="{{ $search ?? '' }}">
                    <button type="submit" class="btn btn-outline-success">Пошук</button>
                </form>
            </div>
        </footer>

        <div class="text-center mb-4">
            <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-lg create-task-btn">
                <i class="fas fa-plus"></i> Створити завдання
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            @forelse ($tasks as $task)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm task-card">
                    <div class="card-body">
                        <h2 class="card-title">{{ $task->title }}</h2>
                        <p class="card-text">{{ $task->description }}</p>
                        <p class="card-text">
                            <small class="text-muted">
                                <strong>Пріоритет:</strong>
                                <span class="badge
                                    @if($task->priority == 'low') bg-success
                                    @elseif($task->priority == 'medium') bg-warning
                                    @elseif($task->priority == 'high') bg-danger
                                    @endif">
                                    {{ $task->priority }}
                                </span>
                                <br>
                                <strong>Дата завершення:</strong> {{ $task->due_date }}
                            </small>
                        </p>
                        @if($task->attachments->isNotEmpty())
                            <div class="mt-2">
                                <strong>Файли:</strong>
                                <div class="row">
                                    @foreach($task->attachments as $attachment)
                                        <div class="col-md-3">
                                            <a href="{{ Storage::url($attachment->file_path) }}" target="_blank">
                                                <img src="{{ Storage::url($attachment->file_path) }}" alt="{{ $attachment->file_name }}" class="img-thumbnail">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="mt-2">
                            <strong>Коментарі:</strong>
                            @if($task->comments->isNotEmpty())
                                <ul class="list-unstyled">
                                    @foreach($task->comments as $comment)
                                        <li class="mb-2">
{{--                                            <strong>{{ $comment->user->name }}:</strong><br>--}}
                                            {{ $comment->content }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>Коментарів поки немає.</p>
                            @endif
                        </div>
                        <div class="mt-2">
                            <strong>Теги:</strong>
                            @if($task->tags->isNotEmpty())
                                @foreach($task->tags as $tag)
                                    <span class="badge bg-secondary">{{ $tag->name }}</span>
                                @endforeach
                            @else
                                <p>Тегів поки немає.</p>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <a href="{{ route('tasks.show', $task) }}" class="btn btn-info btn-sm action-btn">
                                    <i class="fas fa-eye"></i> Переглянути
                                </a>
                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn-sm action-btn">
                                    <i class="fas fa-edit"></i> Редагувати
                                </a>
                            </div>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Ви впевнені, що хочете видалити це завдання?')">
                                    Видалити
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <p>За вашим запитом нічого не знайдено.</p>  {{-- <--- Сообщение, если задач нет --}}
            @endforelse  {{-- <---  Конец цикла @forelse --}}
        </div>  {{-- <---  Конец контейнера --}}

    </div>
@endsection
