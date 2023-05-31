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
        <h1 class="text-center my-4">Создание тега</h1>
                <form method="POST" action="{{ route('tags.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="New Tag" name="name">
                </div>

                <div class="input-group-append mb-3">
                    <button class="btn btn-outline-primary" type="submit">Add Tag</button>
                </div>
                </form>
</div>
@endsection
