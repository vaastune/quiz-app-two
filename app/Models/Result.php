<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the result.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

    // If your table name is not the plural form of the model name, specify it
    // protected $table = 'results';

    // If you need to allow mass assignment, add the following:
    protected $fillable = ['quiz_id', 'user_id', 'score', 'total'];

    // You can add relationships or custom methods here if needed
}
