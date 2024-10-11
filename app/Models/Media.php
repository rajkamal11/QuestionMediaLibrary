<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_url',
        'type',
        'description',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
