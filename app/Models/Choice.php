<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $fillable = ['text', 'is_correct', 'question_id']; // Make sure 'text' is fillable.

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}

