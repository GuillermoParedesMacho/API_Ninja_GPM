<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNinjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ninjas', function (Blueprint $table) {

            //Relaciones
            $table->unsignedBigInteger('Mision_ID')->nullable();
            $table->foreign('Mision_ID')->references('id')->on('misions');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ninjas', function (Blueprint $table) {
            $table->dropColumn(['Mision_ID']);
        });
    }
}
