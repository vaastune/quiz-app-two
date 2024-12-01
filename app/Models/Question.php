<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['text'];

    public function options()
    {
        return $this->hasMany(Option::class);
    }
    // Question.php
public function quiz()
{
    return $this->belongsTo(Quiz::class);
}

public function choices()
{
    return $this->hasMany(Choice::class);
}

    public function choices()
{
    return $this->hasMany(Choice::class);
}

}
