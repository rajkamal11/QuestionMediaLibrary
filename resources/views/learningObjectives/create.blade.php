@extends('layout')

@section('content')
    <h2>Create Learning Objective</h2>
    <form action="{{ route('learningObjectives.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <button type="submit">Create</button>
    </form>
    <a href="{{ route('learningObjectives.index') }}">Back to Learning Objectives</a>
@endsection
