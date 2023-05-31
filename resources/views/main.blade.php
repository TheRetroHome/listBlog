@extends('layouts.layout')
@section('content')
        @if(session()->has('success'))
                        <div class="alert alert-success success-notification">
                            {{session('success')}}
                        </div>
        @endif
@auth
<div class="container">
    <div class="mb-3">
        <form method="GET" action="{{route('search')}}" class="form-inline">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-lg" placeholder="Поиск" name="search">
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-lg" type="submit">Поиск</button>
                        </div>
                    </div>
        </form>
    </div>
    <h1 class="text-center my-4">Задания</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Создать задачу</a>
    <a href="{{ route('tags.index') }}" class="btn btn-primary mb-3">Теги</a>
    <a href="{{ route('tasks.completedView') }}" class="btn btn-primary mb-3">Выполненные задачи</a>
    <ul class="list-group">
        @forelse($tasks as $task)
        <li class="list-group-item">
            @if($task->image)
                <img src="{{ asset($task->image) }}" class="rounded float-left mr-2" alt="Task Image">
            @endif
            {{ $task->name }}
            <div class="mt-2">
                @if($task->tags->count())
                    Теги:
                    @foreach($task->tags as $tag)
                        <a href="{{ route('tasks.tag', $tag->name) }}" class="badge badge-primary">{{ $tag->name }}</a>
                    @endforeach
                @endif
            </div>
            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-outline-warning btn-sm float-right ml-2">Edit</a>
            <form method="POST" action="{{ route('tasks.completed', $task->id) }}" style="display:inline;">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-outline-success btn-sm float-right">Done</button>
            </form>
            <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm float-right mr-2">Delete</button>
            </form>
        </li>
        @empty
        <li class="list-group-item">Ни одного задания не создано</li>
        @endforelse
    </ul>
</div>
                       <div class="card-footer clearfix">
                           {!! $pagination  !!}
                      </div>

@endauth
@guest
<h1 class="text-center my-4">Чтобы воспользоваться функционалом, зарегестрируйтесь или авторизуйтесь</h1>
@endguest
@endsection
