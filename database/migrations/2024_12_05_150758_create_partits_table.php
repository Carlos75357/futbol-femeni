<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartitsTable extends Migration
{
    public function up()
    {
        Schema::create('partits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equip_local_id');
            $table->unsignedBigInteger('equip_visitant_id');

            $table->date('data_partit');
            $table->integer('gols_local')->default(0)->nullable();
            $table->integer('gols_visitant')->default(0)->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('equip_local_id')->references('id')->on('equips')->onDelete('cascade');
            $table->foreign('equip_visitant_id')->references('id')->on('equips')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('partits');
    }
}

