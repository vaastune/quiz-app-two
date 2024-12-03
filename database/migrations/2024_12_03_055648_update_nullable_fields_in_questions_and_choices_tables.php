<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNullableFieldsInQuestionsAndChoicesTables extends Migration
{
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->string('question')->nullable()->change(); // Make 'question' field nullable
        });

        Schema::table('choices', function (Blueprint $table) {
            $table->text('text')->nullable()->change(); // Make 'text' field nullable
        });
    }

    public function down()
    {
        // Optional: Add logic to revert the changes if needed
        Schema::table('questions', function (Blueprint $table) {
            $table->string('question')->nullable(false)->change(); // Revert to not nullable
        });

        Schema::table('choices', function (Blueprint $table) {
            $table->text('text')->nullable(false)->change(); // Revert to not nullable
        });
    }
}
