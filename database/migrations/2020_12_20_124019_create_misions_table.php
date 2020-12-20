<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('misions', function (Blueprint $table) {
            //Datos
            $table->id();
            $table->date('Fecha_Encargo');
            $table->longText('Descripcion');
            $table->unsignedInteger('Ninjas_Estimados');
            $table->boolean('Prioritario');
            $table->longText('Pago');
            $table->enum('Estado',['Pendiente','En_Curso','Completado','Fallado'])->default('Pendiente');
            $table->date('Fecha_Completado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('misions');
    }
}
