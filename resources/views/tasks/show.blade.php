@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-md-6 offset-md-3">
        <h2>{{ $task->title }}</h2>
        <p>{{ $task->description }}</p>
        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
@endsection
