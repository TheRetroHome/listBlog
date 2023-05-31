@extends('layouts.layout')
@section('content')
        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="list-unstyled">
                                    @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
<div class="container">
        <h1 class="text-center my-4">Создание task</h1>
                <form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="New Task" name="name">
                </div>

                <div class="form-group mb-3">
                    <select class="select2" multiple="multiple" data-placeholder="Выбор тегов" style="width: 100%;" name="tags[]" id="tags">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="image">
                        <label class="custom-file-label" for="inputGroupFile01">Выберите изображение</label>
                    </div>
                </div>

                <div class="input-group-append mb-3">
                    <button class="btn btn-outline-primary" type="submit">Add Task</button>
                </div>
                </form>
</div>
@endsection
