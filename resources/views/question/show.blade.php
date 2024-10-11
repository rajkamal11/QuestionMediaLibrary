@extends('layout')

@section('content')
    <h2>Question Details</h2>
    <p><strong>Type:</strong> {{ $question->type }}</p>
    <p><strong>Text:</strong> {{ $question->text }}</p>
    @if ($question->type == 'MCQ')
        <p><strong>Options:</strong></p>
        @if($question->options == null || (is_array($question->options) && empty($question->options)))
            <p>No options available.</p>
        @else
            <ul>
                @foreach(json_decode($question->options) as $option)
                    <li>{{ $option }}</li>
                @endforeach
            </ul>
        @endif
    @endif
    <p><strong>Correct Answer:</strong> {{ $question->correct_answer }}</p>
    <p><strong>Media:</strong> {{ $question->media->description ?? 'None' }}</p>
    <p><strong>Grade:</strong> {{ $question->grade->name }}</p>
    <p><strong>Subject:</strong> {{ $question->subject->name }}</p>
    <p><strong>Learning Objectives:</strong>
    <?php file_put_contents("output.txt",print_r($question,1));?>
    @if($question->learningObjectives->isEmpty())
        <p>No learning objectives assigned.</p>
    @else
        <ul>
            @foreach($question->learningObjectives as $objective)
                <li>{{ $objective->name }}</li>
            @endforeach
        </ul>
    @endif
    <a href="{{ route('question.edit', $question->id) }}">Edit</a>
    <form action="{{ route('question.destroy', $question->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    <a href="{{ route('question.index') }}">Back to Questions</a>
@endsection
