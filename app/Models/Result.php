<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'quiz_id', 'score', 'total']; // Adjust based on your columns

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
