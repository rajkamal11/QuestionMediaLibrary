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
        file_put_contents("outputreq.txt",print_r($request->all(),1));
        $validated = $request->validate([
            // 'file_url' => 'required|url',
            'type' => 'required|in:image,video,document',
            'description' => 'nullable|string',
            'learning_objectives' => 'required|array',
            'learning_objectives.*' => 'exists:learning_objectives,id',
        ]);
        $uploadController = new UploadController();
        $fileUrl = $uploadController->uploadToPath($request, 'media');
        $validated['file_url'] = $fileUrl;

        $media = Media::create($validated);
        $media->learningObjectives()->attach($request->learning_objectives);

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
