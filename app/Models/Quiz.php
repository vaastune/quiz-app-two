<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    // Define the relationship with the Question model
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
