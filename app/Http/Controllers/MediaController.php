<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Models\LearningObjective;

class MediaController extends Controller
{
    public function index()
    {
        $mediaItems = Media::all();
        return view('media.index', compact('mediaItems'));
    }

    public function create()
    {
        $learningObjectives = LearningObjective::all();
        return view('media.create', compact('learningObjectives'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'file_url' => 'required|url',
            'type' => 'required|in:image,video,document',
            'description' => 'nullable|string',
        ]);

        $media = Media::create($validated);
        return redirect()->route('media.show', $media->id);
    }

    public function show($id)
    {
        $media = Media::findOrFail($id);
        return view('media.show', compact('media'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'file_url' => 'required|url',
            'type' => 'required|in:image,video,document',
            'description' => 'nullable|string',
        ]);

        $media = Media::findOrFail($id);
        $media->update($validated);

        return redirect()->route('media.show', $media->id);
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        $media->delete();

        return redirect()->route('media.index');
    }
}
