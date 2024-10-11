@extends('layout')

@section('content')
    <h2>Edit Media</h2>
    <form action="{{ route('media.update', $media->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="file">File (Leave empty to keep current)</label>
            <input type="file" name="file" id="file">
        </div>
        <div>
            <label for="type">Type</label>
            <select name="type" id="type" required>
                <option value="image" {{ $media->type == 'image' ? 'selected' : '' }}>Image</option>
                <option value="video" {{ $media->type == 'video' ? 'selected' : '' }}>Video</option>
                <option value="document" {{ $media->type == 'document' ? 'selected' : '' }}>Document</option>
            </select>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description">{{ $media->description }}</textarea>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
