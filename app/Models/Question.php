<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // Define the relationship with the Quiz model (optional, for reverse lookup)
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
    public function choices()
{
    return $this->hasMany(Choice::class);
}

}

