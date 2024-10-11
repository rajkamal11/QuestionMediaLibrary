@extends('layout')

@section('content')
    <h2>Edit Learning Objective</h2>
    <form action="{{ route('learningObjectives.update', $learningObjective->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ $learningObjective->name }}" required>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description">{{ $learningObjective->description }}</textarea>
        </div>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('learningObjectives.index') }}">Back to Learning Objectives</a>
@endsection
