<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTotalColumnInResultsTable extends Migration
{
    public function up()
    {
        Schema::table('results', function (Blueprint $table) {
            $table->integer('total')->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('results', function (Blueprint $table) {
            $table->integer('total')->change(); // Removes the default if rolled back
        });
    }
}
