<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    public function quizzes()
{
    return $this->belongsToMany(Quiz::class, 'user_quiz');
}

}
