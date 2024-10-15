<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factories\QuestionFactory;
use App\Models\Question;
use App\Models\Media;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\LearningObjective;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return view('question.index', compact('questions'));
    }

    public function create()
    {
        $grades = Grade::all();
        $subjects = Subject::all();
        $media = Media::all();
        $learningObjectives = LearningObjective::all();
        return view('question.create', compact('grades', 'subjects', 'media', 'learningObjectives'));
    }

    public function store(Request $request)
    {
        file_put_contents("outputreq.txt",print_r($request->all(),1));
        $request->validate([
            'text' => 'required|string',
            'type' => 'required|string|in:mcq,Fill-in-the-Blanks',
            'media_id' => 'nullable|exists:media,id',
            'grade_id' => 'required|exists:grades,id',
            'subject_id' => 'required|exists:subjects,id',
            'learning_objectives' => 'required|array',
            
        ]);
        file_put_contents("output.txt", "45 here====================");
        $data = $request->except('learning_objectives');
        $question = null;

        $nexiId = Question::max('id') + 1;
        $uploadController = new UploadController();
        $fileUrl = $uploadController->uploadToPath($request, 'questions/'.$nexiId);
        $data['media_url'] = $fileUrl;
        
        $question = QuestionFactory::create($data);
        $question->learningObjectives()->attach($request->learning_objectives);

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
        $request->validate([
            'text' => 'required|string',
            'type' => 'required|string',
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
