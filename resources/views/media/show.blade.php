@extends('layout')

@section('content')
    <h2>Media Details</h2>
    <p><strong>File:</strong> <a href="{{ $media->file_url }}" target="_blank">View</a></p>
    <p><strong>Type:</strong> {{ $media->type }}</p>
    <p><strong>Description:</strong> {{ $media->description }}</p>
    <p><strong>Learning Objective:</strong> {{ $media->learningObjective->name ?? 'None' }}</p>
    <a href="{{ route('media.edit', $media->id) }}">Edit</a>
    <form action="{{ route('media.destroy', $media->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    <a href="{{ route('media.index') }}">Back to Media</a>
@endsection
