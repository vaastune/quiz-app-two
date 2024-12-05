<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{

    // Combine the properties into one declaration
    protected $fillable = ['title', 'category'];

    // Define the relationship with the Question model
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function index()
{
    $quizzes = Quiz::with('category')->get(); // Ensure you load the category relation
    return view('quizzes.index', compact('quizzes'));
}
    public function showResults($id)
    {
        $results = Result::where('quiz_id', $id)->get();
        return view('quizzes.results', compact('results'));
    }
    public function category()
{
    return $this->belongsTo(Category::class);
}



}
