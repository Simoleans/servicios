<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteAllForeignPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('payments');

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('servicio_id')->nullable()->constrained('servicios');
            $table->foreignId('ciclo_id')->nullable()->constrained('ciclo_servicios');
            $table->foreignId('producto_id')->nullable()->constrained('productos');
            $table->foreignId('ticket_id')->nullable()->constrained('tickets');
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
        Schema::table('payments', function (Blueprint $table) {
            //
        });
    }
}
