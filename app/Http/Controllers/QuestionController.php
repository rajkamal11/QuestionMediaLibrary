<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Media; // Import if you need to link media
use App\Models\Grade; // Assuming you have a Grade model
use App\Models\Subject; // Assuming you have a Subject model
use App\Models\LearningObjective; // Assuming you have a Learning Objective model
use App\Models\MCQQuestion; // Assuming you have a MCQQuestion model
use App\Models\FillInTheBlankQuestion; // Assuming you have a FillInTheBlankQuestion model

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all(); // Fetch all questions
        return view('question.index', compact('questions'));
    }

    public function create()
    {
        $grades = Grade::all(); // Fetch all grades
        $subjects = Subject::all(); // Fetch all subjects
        $media = Media::all(); // Fetch all media
        $learningObjectives = LearningObjective::all(); // Fetch all LOs
        return view('question.create', compact('grades', 'subjects', 'media', 'learningObjectives'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'text' => 'required|string',
        //     'type' => 'required|string',
        //     'media_id' => 'nullable|exists:media,id',
        //     'grade_id' => 'required|exists:grades,id',
        //     'subject_id' => 'required|exists:subjects,id',
        //     'learning_objectives' => 'required|array',
        //     'learning_objectives.*' => 'exists:learning_objectives,id',  
        // ]);
        // // file_put_contents("output.txt",print_r($request->all(),1));
        // $question = Question::create($request->except('learning_objectives'));

        file_put_contents("outputreq.txt",print_r($request->all(),1));
        $request->validate([
            'text' => 'required|string',
            'type' => 'required|string|in:mcq,Fill-in-the-Blanks',
            'media_id' => 'nullable|exists:media,id',
            'grade_id' => 'required|exists:grades,id',
            'subject_id' => 'required|exists:subjects,id',
            'learning_objectives' => 'required|array',
            // 'learning_objectives.*' => 'exists:learning_objectives,id',
            // 'options' => 'required_if:type,MCQ|array|max:5',
            // 'options.*' => 'string|distinct',
            // 'correct_answer' => 'required|string',
        ]);
        file_put_contents("output.txt", "57 here====================");
        $data = $request->except('learning_objectives');
        $question = null;
        
        if ($request->type === 'mcq') {
            $data['options'] = json_encode($request->options);
            $question = MCQQuestion::create($data);
        } else {
            $question = FillInTheBlankQuestion::create($data);
        }
        file_put_contents("outputdata.txt", print_r($data,1));
        $question->learningObjectives()->attach($request->learning_objectives);

        file_put_contents("output.txt", "69 here====================");

        return redirect()->route('question.index')->with('success', 'Question created successfully.');
    }

    public function show($id)
    {
        $question = Question::findOrFail($id);
        return view('question.show', compact('question'));
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $grades = Grade::all();
        $subjects = Subject::all();
        $media = Media::all();
        $learningObjectives = LearningObjective::all();
        
        return view('question.edit', compact('question', 'grades', 'subjects', 'media', 'learningObjectives'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update the question
        $request->validate([
            'text' => 'required|string',
            'type' => 'required|string',
            'media_id' => 'nullable|exists:media,id',
            'grade_id' => 'required|exists:grades,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $question = Question::findOrFail($id);
        $question->update($request->all());

        return redirect()->route('question.index')->with('success', 'Question updated successfully.');
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('question.index')->with('success', 'Question deleted successfully.');
    }
}
