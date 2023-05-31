@extends('layouts.layout')
@section('content')
        @if(session()->has('success'))
                        <div class="alert alert-success success-notification">
                            {{session('success')}}
                        </div>
        @endif
@auth
<div class="container">
        <h1 class="text-center my-4">Tasks</h1>
         <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Создать задачу</a>
         <a href="{{ route('tags.index') }}" class="btn btn-primary mb-3">Теги</a>
         <a href="{{ route('main') }}" class="btn btn-primary mb-3">Выполненные задачи</a>
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
                    <span class="badge badge-primary">{{ $tag->name }}</span>
                @endforeach
            @endif
            </div>
            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-outline-warning btn-sm float-right ml-2">Edit</a>
            <button class="btn btn-outline-success btn-sm float-right">Done</button>

            <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm float-right mr-2">Delete</button>
            </form>
        </li>
    @empty
        <li class="list-group-item">No tasks yet</li>
    @endforelse
</ul>

    </div>
@endauth
@guest
<h1 class="text-center my-4">Чтобы воспользоваться функционалом, зарегестрируйтесь или авторизируйтесь</h1>
@endguest
@endsection
