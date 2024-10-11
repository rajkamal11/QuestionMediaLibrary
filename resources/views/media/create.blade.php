@extends('layout')

@section('content')
    <h2>Upload Media</h2>
    <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="file">File</label>
            <input type="file" name="file" id="file" required>
        </div>
        <div>
            <label for="type">Type</label>
            <select name="type" id="type" required>
                <option value="image">Image</option>
                <option value="video">Video</option>
                <option value="document">Document</option>
            </select>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <div>
            <label for="lo_id">Learning Objective</label>
            <select name="lo_id" id="lo_id" required>
                @foreach($learningObjectives as $lo)
                    <option value="{{ $lo->id }}">{{ $lo->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Upload</button>
    </form>
@endsection
