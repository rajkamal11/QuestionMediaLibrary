@extends('layout')

@section('content')
    <h2>Media Library</h2>
    <a href="{{ route('media.create') }}">Upload New Media</a>
    <table>
        <thead>
            <tr>
                <th>File</th>
                <th>Type</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($media as $item)
                <tr>
                    <td><a href="{{ $item->file_url }}" target="_blank">View</a></td>
                    <td>{{ $item->type }}</td>
                    <td>{{ $item->description }}</td>
                    <td>
                        <a href="{{ route('media.show', $item->id) }}">View</a>
                        <a href="{{ route('media.edit', $item->id) }}">Edit</a>
                        <form action="{{ route('media.destroy', $item->id) }}" method="POST" style="display:inline;">
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
``
