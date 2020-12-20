<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('misions', function (Blueprint $table) {
            //Relaciones
            $table->unsignedBigInteger('id_Cliente');
            $table->foreign('id_Cliente')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('misions', function (Blueprint $table) {
            $table->dropColumn(['id_Cliente']);
        });
    }
}
