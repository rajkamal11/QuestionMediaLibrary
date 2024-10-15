@extends('layout')

@section('content')
    <h2>Create Question</h2>
    <form action="{{ route('question.store') }}" method="POST" class="mt-4" id="question-form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="text">Question Text</label>
            <input type="text" name="text" id="text" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="type">Question Type</label>
            <select name="type" id="type" class="form-control" required>
                <option value="mcq">Multiple Choice Question</option>
                <option value="Fill-in-the-Blanks">Fill in the Blanks</option>
            </select>
        </div>
        <div id="mcq-options" class="form-group" style="display: none;">
            <label for="options">Options</label>
            <div id="options-container">
                <div class="input-group mb-2">
                    <input type="text" name="options[]" class="form-control" placeholder="Option 1">
                    <div class="input-group-append">
                        <button class="btn btn-danger remove-option" type="button">&times;</button>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary" id="add-option">Add Option</button>
            <div class="form-group mt-3">
                <label for="mcq_answer">Correct Answer</label>
                <select name="mcq_answer" id="mcq_answer" class="form-control">
                    <!-- Options will be populated dynamically -->
                </select>
            </div>
        </div>
        <div id="text-answer" class="form-group" style="display: none;">
            <label for="answer">Correct Answer</label>
            <input type="text" name="text_answer" id="text_answer" class="form-control">
        </div>
        <input type="hidden" name="correct_answer" id="hidden_answer">

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const typeSelect = document.getElementById('type');
                const mcqOptions = document.getElementById('mcq-options');
                const textAnswer = document.getElementById('text-answer');
                const optionsContainer = document.getElementById('options-container');
                const addOptionButton = document.getElementById('add-option');
                const mcqAnswerInput = document.getElementById('mcq_answer');
                const hiddenAnswer = document.getElementById('hidden_answer');
                const textAnswerInput = document.getElementById('text_answer');
                const questionForm = document.getElementById('question-form');

                typeSelect.addEventListener('change', function () {
                    if (this.value === 'mcq') {
                        mcqOptions.style.display = 'block';
                        textAnswer.style.display = 'none';
                    } else {
                        mcqOptions.style.display = 'none';
                        textAnswer.style.display = 'block';
                    }
                });

                questionForm.addEventListener('submit', function () {
                    if (typeSelect.value === 'mcq') {
                        const options = optionsContainer.querySelectorAll('input[name="options[]"]');
                        if (options.length < 2) {
                            alert('You need to add at least 2 options.');
                            return false;
                        }
                        const correctAnswer = mcqAnswerInput.value;
                        if (!correctAnswer) {
                            alert('You need to select a correct answer.');
                            return false;
                        }
                        hiddenAnswer.value = mcqAnswerInput.value;
                    } else {
                        mcqAnswerInput.value = textAnswerInput.value;
                        hiddenAnswer.value = textAnswerInput.value;
                    }
                });

                addOptionButton.addEventListener('click', function () {
                    if (optionsContainer.children.length >= 5) {
                        alert('You can only add up to 5 options.');
                        return;
                    }
                    const optionCount = optionsContainer.children.length + 1;
                    const optionDiv = document.createElement('div');
                    optionDiv.classList.add('input-group', 'mb-2');
                    optionDiv.innerHTML = `
                        <input type="text" name="options[]" class="form-control" placeholder="Option ${optionCount}">
                        <div class="input-group-append">
                            <button class="btn btn-danger remove-option" type="button">&times;</button>
                        </div>
                    `;
                    optionsContainer.appendChild(optionDiv);
                    updateCorrectAnswerOptions();
                });

                optionsContainer.addEventListener('click', function (e) {
                    if (e.target.classList.contains('remove-option')) {
                        e.target.closest('.input-group').remove();
                        updateCorrectAnswerOptions();
                    }
                });

                function updateCorrectAnswerOptions() {
                    mcqAnswerInput.innerHTML = '';
                    const options = optionsContainer.querySelectorAll('input[name="options[]"]');
                    options.forEach((option, index) => {
                        const optionValue = option.value || `Option ${index + 1}`;
                        const optionElement = document.createElement('option');
                        optionElement.value = optionValue;
                        optionElement.textContent = optionValue;
                        mcqAnswerInput.appendChild(optionElement);
                    });
                }

                textAnswerInput.addEventListener('input', function () {
                    hiddenAnswer.value = this.value;
                });
            });
        </script>
        <div class="form-group">
            <label for="file">Question Media</label>
            <input type="file" name="file" id="file" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="grade_id">Grade</label>
            <select name="grade_id" id="grade_id" class="form-control" required>
                @foreach($grades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="subject_id">Subject</label>
            <select name="subject_id" id="subject_id" class="form-control" required>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="learning_objectives">Learning Objectives (multiple)</label>
            <select name="learning_objectives[]" id="learning_objectives" class="form-control" multiple required>
                @foreach($learningObjectives as $lo)
                    <option value="{{ $lo->id }}">{{ $lo->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Create</button>
        <a href="{{ route('question.index') }}" class="btn btn-secondary mt-3">Back to Questions</a>
    </form>
@endsection
