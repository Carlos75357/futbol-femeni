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
        Schema::table('equips', function (Blueprint $table) {
            $table->foreign('estadi_id')->references('id')->on('estadis')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equips', function (Blueprint $table) {
            $table->dropForeign(['estadi_id']);
            $table->dropColumn('estadi_id');
        });
    }
};