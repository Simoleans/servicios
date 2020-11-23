<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMercadoPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_mercado_pagos', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id')->nullable()->comment('el id del pago');
            $table->string('payment_type_id')->nullable()->comment('tipo de pago');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('customer_id')->constrained('customer_mercado_pagos');
            $table->string('status_pago_mp')->nullable()->comment('status del pago en mercado pago');
            $table->tinyInteger('status')->default(1)->comment('status del pago en sistema');
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
        Schema::dropIfExists('payment_mercado_pagos');
    }
}
