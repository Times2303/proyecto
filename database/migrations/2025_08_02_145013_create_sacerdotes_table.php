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
        Schema::create('sacerdotes', function (Blueprint $table) {
            $table->id();
            $table->date('fec_inicio');
            $table->date('fec_fin')->nullable();
            $table->unsignedBigInteger('personas_id');
            $table->unsignedBigInteger('jerarquias_id');
            $table->unsignedBigInteger('parroquias_id');
            $table->timestamps();

            $table->foreign('personas_id')
            ->references('id')->on('personas')
            ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('jerarquias_id')
            ->references('id')->on('jerarquias')
            ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('parroquias_id')
            ->references('id')->on('parroquias')
            ->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sacerdotes');
    }
};
