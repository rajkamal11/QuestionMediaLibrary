<?php
namespace App\Factories;

use App\Models\MCQQuestion;
use App\Models\FillInTheBlankQuestion;

class QuestionFactory
{
    public static function create(array $data)
    {
        switch ($data['type']) {
            case 'mcq':
                $data['options'] = json_encode($data['options']);
                return MCQQuestion::create($data);
            case 'Fill-in-the-Blanks':
                return FillInTheBlankQuestion::create($data);
            default:
                throw new \InvalidArgumentException("Invalid question type: {$data['type']}");
        }
    }
}