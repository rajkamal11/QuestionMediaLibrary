<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LearningObjective;

class LearningObjectiveController extends Controller
{
    public function index()
    {
        $learningObjectives = LearningObjective::all(); // Fetch all learning objectives
        return view('learningObjectives.index', compact('learningObjectives'));
    }

    public function create()
    {
        return view('learningObjectives.create'); // Show form to create a new learning objective
    }

    public function store(Request $request)
    {
        // Validate and store the new learning objective
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        LearningObjective::create($request->all());

        return redirect()->route('learningObjectives.index')->with('success', 'Learning Objective created successfully.');
    }

    public function show($id)
    {
        $learningObjective = LearningObjective::findOrFail($id);
        return view('learningObjectives.show', compact('learningObjective'));
    }

    public function edit($id)
    {
        $learningObjective = LearningObjective::findOrFail($id);
        return view('learningObjectives.edit', compact('learningObjective'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update the learning objective
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $learningObjective = LearningObjective::findOrFail($id);
        $learningObjective->update($request->all());

        return redirect()->route('learningObjectives.index')->with('success', 'Learning Objective updated successfully.');
    }

    public function destroy($id)
    {
        $learningObjective = LearningObjective::findOrFail($id);
        $learningObjective->delete();

        return redirect()->route('learningObjectives.index')->with('success', 'Learning Objective deleted successfully.');
    }
}
