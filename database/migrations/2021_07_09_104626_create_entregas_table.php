<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntregasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cliente_id')->unsigned();
            $table->bigInteger('orden_id')->unsigned();
            $table->string('qr', 255);
            $table->date('fecha_entrega');
            $table->time('hora_entrega');
            $table->dateTime('fecha_hora_entrega');
            $table->string('estado');
            $table->date('fecha_registro');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes')->ondelete('no action')->onupdate('cascade');
            $table->foreign('orden_id')->references('id')->on('ordens')->ondelete('no action')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entregas');
    }
}
