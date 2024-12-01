<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAnswersTable extends Migration
{
    public function up()
    {
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
{
    Schema::table('user_answers', function (Blueprint $table) {
        $table->dropForeign(['question_id']); // Drop the foreign key constraint for question_id
    });
    Schema::dropIfExists('user_answers');
}


}
