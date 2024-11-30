<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'title', // Add other attributes as needed, e.g., 'user_id' if you have that
    ];
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
