<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function category()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        return $this->belongsTo(Category::class);
    }

    public function quizzes()
{
    return $this->hasMany(Quiz::class);
}


};

