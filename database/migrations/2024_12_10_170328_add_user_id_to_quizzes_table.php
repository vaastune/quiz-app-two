<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   // Create a new migration with: php artisan make:migration add_foreign_key_to_quizzes_table
public function up()
{
    Schema::table('quizzes', function (Blueprint $table) {
        $table->bigInteger('user_id')->unsigned()->change();
        $table->foreign('user_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('quizzes', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
    });
}

};
