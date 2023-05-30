@extends('layouts.layout')
@section('content')
        @if(session()->has('success'))
                        <div class="alert alert-success success-notification">
                            {{session('success')}}
                        </div>
        @endif
<div class="container">
        <h1 class="text-center my-4">ToDo List</h1>

        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="New Task">
        </div>

        <div class="form-group mb-3">
            <select class="select2" multiple="multiple" data-placeholder="Выбор тегов" style="width: 100%;" name="tags[]" id="tags">
                <option value="Работа">Работа</option>
                <option value="Учёба">Учёба</option>
                <option value="Развлечение">Развлечение</option>
                <option value="Прочее">Прочее</option>
            </select>
        </div>

        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile01">
                <label class="custom-file-label" for="inputGroupFile01">Выберите изображение</label>
            </div>
        </div>

        <div class="input-group-append mb-3">
            <button class="btn btn-outline-primary" type="button">Add Task</button>
        </div>

        <ul class="list-group">
            <li class="list-group-item">
                <img src="https://via.placeholder.com/150" class="rounded float-left mr-2" alt="Task Image">
                Task 1
                <div class="mt-2">
                    <span class="badge badge-primary">Работа</span>
                    <span class="badge badge-success">Учёба</span>
                    <span class="badge badge-danger">Развлечение</span>
                    <span class="badge badge-dark">Прочее</span>
                </div>
                <button class="btn btn-outline-warning btn-sm float-right ml-2">Edit</button>
                <button class="btn btn-outline-success btn-sm float-right">Done</button>
                <button class="btn btn-outline-danger btn-sm float-right mr-2">Delete</button>
            </li>
            <!-- More tasks... -->
        </ul>
    </div>
@endsection
