@extends('app')

@section('content')
    <div class="container w-25 border p-4 my-4">
        <div class="row mx-auto">
            <form action="{{route('categories.update',['category'=>$category->id])}}" method="POST">
                @method('PATCH')
                @csrf

                @if (session('success'))
                    <h6 class="alert alert-success">{{ session('success') }}</h6>
                @endif

                @error('name')
                <h6 class="alert alert-danger">{{$message}}</h6>
                @enderror
                <div class="mb-3">
                    <label for="name" class="form-label">Titulo de la Categoria</label>
                    <input type="text" class="form-control" name="name" value="{{$category->name}}">
                </div>

                <div class="mb-3">
                    <label for="color" class="form-label">Color de la tarea</label>
                    <input type="color" class="form-control" name="color" value="{{$category->color}}">
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Categoria</button>
            </form>

            @if($category->todos->count()>0)
                @foreach($category->todos as $todo)
                    <div class="row py-1">
                        <div class="col-md-9 d-flex align-items-center">
                            <a href="{{ route('todos-edit', ['id' => $todo->id]) }}">{{ $todo->title }}</a>
                        </div>
                    </div>
                @endforeach
            @else
            <div>
                <strong>No hay tareas asignadas</strong>
            </div>
            @endif
        </div>
@endsection
