<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('equips', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->integer('titols')->default(0);
            $table->string('escut')->nullable();
            $table->unsignedBigInteger('estadi_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equips');
    }
};