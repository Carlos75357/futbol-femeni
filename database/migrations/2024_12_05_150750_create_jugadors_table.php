<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJugadorsTable extends Migration
{
    public function up()
    {
        Schema::create('jugadors', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->unsignedBigInteger('equip_id'); 
            $table->string('posicio');
            $table->string('foto')->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('equip_id')->references('id')->on('equips')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jugadors');
    }
}
