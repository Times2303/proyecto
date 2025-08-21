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
        Schema::create('matriculados', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fec_matricula');
            $table->date('fec_misa_acordada');
            $table->text('observaciones')->nullable();
            $table->boolean('estado')->default(false);
            $table->unsignedBigInteger('personas_id');
            $table->unsignedBigInteger('estado_matricula_id');
            $table->unsignedBigInteger('sacramentos_id');
            $table->unsignedBigInteger('documentos_id');
            $table->unsignedBigInteger('comprobantes_id');


            $table->foreign('personas_id')
            ->references('id')->on('personas')
            ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('estado_matricula_id')
            ->references('id')->on('estado_matricula')
            ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('sacramentos_id')
            ->references('id')->on('sacramentos')
            ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('documentos_id')
            ->references('id')->on('documentos')
            ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('comprobantes_id')
            ->references('id')->on('comprobantes')
            ->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculados');
    }
};
