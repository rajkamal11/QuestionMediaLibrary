@extends('layout')

@section('content')
    <h2>Learning Objective Details</h2>
    <p><strong>Name:</strong> {{ $learningObjective->name }}</p>
    <p><strong>Description:</strong> {{ $learningObjective->description }}</p>
    
    <a href="{{ route('learningObjectives.edit', $learningObjective->id) }}">Edit</a>
    <form action="{{ route('learningObjectives.destroy', $learningObjective->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    <a href="{{ route('learningObjectives.index') }}">Back to Learning Objectives</a>
@endsection
