<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['quiz_id', 'question']; // Ensure 'question' is fillable if you need mass assignment here.

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}

