<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    protected $fillable = ['quiz_id', 'question'];

    // If you are using relationships:
    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}
