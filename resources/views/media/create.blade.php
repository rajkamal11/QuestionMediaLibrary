@extends('layout')

@section('content')
<div class="container">
    <h1>Create New Media</h1>
    <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="file" name="file" id="file" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" id="type" class="form-control" required>
                <option value="image">Image</option>
                <option value="video">Video</option>
                <option value="document">Document</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="learning_objectives">Learning Objectives</label>
            <select name="learning_objectives[]" id="learning_objectives" class="form-control" multiple required>
                @foreach($learningObjectives as $learningObjective)
                    <option value="{{ $learningObjective->id }}">{{ $learningObjective->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
