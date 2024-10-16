<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function learningObjectives()
    {
        return $this->hasMany(LearningObjective::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}

