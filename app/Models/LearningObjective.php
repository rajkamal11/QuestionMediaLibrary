<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningObjective extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_learning_objective');
    }

    public function media()
    {
        return $this->belongsToMany(Media::class, 'learning_objective_media');
    }
}
