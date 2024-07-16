@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-md-6 offset-md-3">
        <h2>Edit Task</h2>
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description">{{ $task->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
</div>
@endsection
