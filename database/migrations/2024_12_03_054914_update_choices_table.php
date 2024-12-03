<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateChoicesTable extends Migration
{
    public function up()
    {
        Schema::table('choices', function (Blueprint $table) {
            $table->text('text')->nullable()->change(); // Alter existing column to make it nullable
        });
    }

    public function down()
    {
        Schema::table('choices', function (Blueprint $table) {
            $table->text('text')->nullable(false)->change(); // Revert to non-nullable if necessary
        });
    }
};

