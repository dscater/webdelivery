<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('entrega_id')->unsigned();
            $table->string('metodo_pago', 255);
            $table->date('fecha_pago');
            $table->time('hora_pago');
            $table->dateTime('fecha_hora_pago');
            $table->decimal('total_pago', 24, 2);
            $table->date('fecha_registro');
            $table->timestamps();

            $table->foreign('entrega_id')->references('id')->on('entregas')->ondelete('no action')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
