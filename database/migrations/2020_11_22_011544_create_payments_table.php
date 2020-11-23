<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('servicio_id')->constrained('servicios')->nullable();
            $table->foreignId('ciclo_id')->constrained('ciclo_servicios')->nullable();
            $table->foreignId('producto_id')->constrained('productos')->nullable();
            $table->foreignId('ticket_id')->constrained('tickets')->nullable();
            $table->float('monto');
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
        Schema::dropIfExists('payments');
    }
}
