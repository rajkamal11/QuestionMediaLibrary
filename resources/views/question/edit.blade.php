@extends('layout')

@section('content')
    <h2>Edit Question</h2>
    <form action="{{ route('question.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="type">Question Type</label>
            <select name="type" id="type" required>
                <option value="MCQ" {{ $question->type == 'MCQ' ? 'selected' : '' }}>Multiple Choice</option>
                <option value="Fill-in-the-Blanks" {{ $question->type == 'Fill-in-the-Blanks' ? 'selected' : '' }}>Fill in the Blanks</option>
            </select>
        </div>
        <div>
            <label for="text">Question Text</label>
            <textarea name="text" id="text" required>{{ $question->text }}</textarea>
        </div>
        <div>
            <label for="media_id">Media</label>
            <select name="media_id" id="media_id">
                <option value="">None</option>
                @foreach($media as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $question->media_id ? 'selected' : '' }}>{{ $item->description }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="grade_id">Grade</label>
            <select name="grade_id" id="grade_id" required>
                @foreach($grades as $grade)
                    <option value="{{ $grade->id }}" {{ $grade->id == $question->grade_id ? 'selected' : '' }}>{{ $grade->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="subject_id">Subject</label>
            <select name="subject_id" id="subject_id" required>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $subject->id == $question->subject_id ? 'selected' : '' }}>{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
