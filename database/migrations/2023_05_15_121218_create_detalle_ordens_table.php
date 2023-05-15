<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleOrdensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ordens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("orden_id");
            $table->unsignedBigInteger("producto_id");
            $table->decimal("precio", 24, 2);
            $table->double("cantidad");
            $table->decimal("subtotal");
            $table->timestamps();

            $table->foreign("orden_id")->on("ordens")->references("id")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_ordens');
    }
}
