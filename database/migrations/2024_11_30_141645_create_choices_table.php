<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('choices', function (Blueprint $table) {
        $table->id();
        $table->foreignId('question_id')->constrained()->onDelete('cascade');
        $table->text('text')->nullable();
        $table->string('text'); // Ensure this field exists and is not nullable
        $table->boolean('is_correct')->default(false); // Default value if needed
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('choices');
    }
}
