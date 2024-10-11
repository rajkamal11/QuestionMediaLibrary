<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'text', 'media_id', 'grade_id', 'subject_id', 'options', 'correct_answer'
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->type === 'MCQ') {
                $model->options = json_encode($model->options);
            }
        });
    }

    public function learningObjectives()
    {
        return $this->belongsToMany(LearningObjective::class, 
        'question_learning_objective', 'question_id', 'learning_objective_id');
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
