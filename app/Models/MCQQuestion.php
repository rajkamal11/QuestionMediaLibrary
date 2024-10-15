<?php
namespace App\Models;

class MCQQuestion extends Question
{
    protected $table = 'questions';

    protected $fillable = [
        'type', 'text', 'media_url', 'grade_id', 'subject_id', 'options', 'correct_answer'
    ];

    protected $casts = [
        'options' => 'array',
    ];
}