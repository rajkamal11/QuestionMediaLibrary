<?php
namespace App\Models;

class FillInTheBlankQuestion extends Question
{
    protected $table = 'questions';

    protected $fillable = [
        'type', 'text', 'media_url', 'grade_id', 'subject_id', 'correct_answer'
    ];
}