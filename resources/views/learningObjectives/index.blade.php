@extends('layout')

@section('content')
    <h2>Learning Objectives</h2>
    <a href="{{ route('learningObjectives.create') }}">Create New Learning Objective</a>
    
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($learningObjectives as $learningObjective)
                <tr>
                    <td>{{ $learningObjective->name }}</td>
                    <td>{{ $learningObjective->description }}</td>
                    <td>
                        <a href="{{ route('learningObjectives.show', $learningObjective->id) }}">View</a>
                        <a href="{{ route('learningObjectives.edit', $learningObjective->id) }}">Edit</a>
                        <form action="{{ route('learningObjectives.destroy', $learningObjective->id) }}" method="POST" style="display:inline;">
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
