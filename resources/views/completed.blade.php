@extends('layouts.layout')
@section('content')
        @if(session()->has('success'))
                        <div class="alert alert-success success-notification">
                            {{session('success')}}
                        </div>
        @endif
@auth
<div class="container">
        <h1 class="text-center my-4">Выполненные задачи</h1>
         <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Создать задачу</a>
         <a href="{{ route('tags.index') }}" class="btn btn-primary mb-3">Теги</a>
         <a href="{{ route('main') }}" class="btn btn-primary mb-3">Незавершенные задачи</a>
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
        </li>
    @empty
        <li class="list-group-item">Нет выполненных задач</li>
    @endforelse
</ul>

    </div>
@endauth
@guest
<h1 class="text-center my-4">Чтобы воспользоваться функционалом, зарегестрируйтесь или авторизируйтесь</h1>
@endguest
@endsection
