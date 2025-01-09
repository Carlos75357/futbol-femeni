<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('partits', function (Blueprint $table) {
            $table->unsignedBigInteger('estadi_id')->nullable();
            $table->foreign('estadi_id')->references('id')->on('estadis')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partits', function (Blueprint $table) {
            $table->dropForeign(['estadi_id']);
            $table->dropColumn('estadi_id');
        });
    }
};
