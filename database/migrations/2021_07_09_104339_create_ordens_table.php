<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordens', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nro_orden');
            $table->bigInteger('empresa_id')->unsigned();
            $table->bigInteger('producto_id')->unsigned();
            $table->double('cantidad', 8, 2);
            $table->bigInteger('cliente_id')->unsigned();
            $table->bigInteger('distribuidor_id')->unsigned();
            $table->date('fecha_pedido');
            $table->time('hora_pedido');
            $table->dateTime('fecha_hora_pedido');
            $table->date('fecha_entrega');
            $table->time('hora_entrega');
            $table->dateTime('fecha_hora_entrega');
            $table->string('estado');
            $table->date('fecha_registro');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('users')->ondelete('no action')->onupdate('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->ondelete('no action')->onupdate('cascade');
            $table->foreign('cliente_id')->references('id')->on('clientes')->ondelete('no action')->onupdate('cascade');
            $table->foreign('distribuidor_id')->references('id')->on('users')->ondelete('no action')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordens');
    }
}
