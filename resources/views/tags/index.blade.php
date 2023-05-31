@extends('layouts.layout')
@section('content')
        @if(session()->has('success'))
                        <div class="alert alert-success success-notification">
                            {{session('success')}}
                        </div>
        @endif
@auth
<div class="container">
    <h1 class="text-center my-4">Теги</h1>
    <a href="{{ route('tags.create') }}" class="btn btn-primary mb-3">Создать тег</a>
    <a href="{{ route('main') }}" class="btn btn-primary mb-3">Задачи</a>
    <ul class="list-group">
    @forelse($tags as $tag)
    <li class="list-group-item">
        {{ $tag->name }}
        <form method="POST" action="{{ route('tags.destroy', $tag->id) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger btn-sm float-right mr-2">Удалить</button>
        </form>
    </li>
    @empty
    <li class="list-group-item">Тегов пока нет</li>
    @endforelse
    </ul>
</div>

@endauth
@guest
<h1 class="text-center my-4">Чтобы воспользоваться функционалом, зарегестрируйтесь или авторизируйтесь</h1>
@endguest
@endsection
