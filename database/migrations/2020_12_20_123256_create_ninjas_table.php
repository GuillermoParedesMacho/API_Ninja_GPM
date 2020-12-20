<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNinjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ninjas', function (Blueprint $table) {
            //Datos
            $table->id();
            $table->char('Nombre',100);
            $table->enum('Rango',['Novato','Soldado','Veterano','Maestro']);
            $table->date('Fecha_Registro');
            $table->longText('Informe_Habilidades');
            $table->enum('Estado',['Activo','Retirado','Fallecido','Desertor']);
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
        Schema::dropIfExists('ninjas');
    }
}
