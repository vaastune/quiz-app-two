<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    // If your table name is not the plural form of the model name, specify it
    // protected $table = 'results';

    // If you need to allow mass assignment, add the following:
    protected $fillable = ['quiz_id', 'user_id', 'score', 'total'];

    // You can add relationships or custom methods here if needed
}
