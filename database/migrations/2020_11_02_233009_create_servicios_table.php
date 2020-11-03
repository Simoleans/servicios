<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion_corta');
            $table->longText('descripcion_larga');
            $table->string('foto');
            $table->float('precio_normal');
            $table->float('precio_rebajado');
            $table->integer('dias_pruebas');
            $table->integer('dias_suspender');
            $table->integer('dias_notificar');
            $table->integer('ciclo_facturacion')->comment('ciclos por MESES');
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
        Schema::dropIfExists('servicios');
    }
}
