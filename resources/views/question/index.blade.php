@extends('layout')

@section('content')
    <h2>Question Library</h2>
    <a href="{{ route('question.create') }}">Create New Question</a>
    <table>
        <thead>
            <tr>
                <th>Question</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $question)
                <tr>
                    <td>{{ $question->text }}</td>
                    <td>{{ $question->type }}</td>
                    <td>
                        <a href="{{ route('question.show', $question->id) }}">View</a>
                        <a href="{{ route('question.edit', $question->id) }}">Edit</a>
                        <form action="{{ route('question.destroy', $question->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
