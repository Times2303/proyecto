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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 45);
            $table->string('apellido1', 45);
            $table->string('apellido2', 45)->nullable();
            $table->string('email', 100)->unique();
            $table->date('fecha_nacimiento');
            $table->string('direccion', 100);
            $table->string('celular', 9);
            $table->boolean('estado')->default(true);
            $table->unsignedBigInteger('tipo_identificacion_id');
            $table->unsignedBigInteger('nacionalidad_id');
            $table->string('numero_identificacion', 9)->unique();
            $table->timestamps();

            $table->foreign('tipo_identificacion_id')
            ->references('id')->on('tipos_identificacion')
            ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('nacionalidad_id')
            ->references('id')->on('nacionalidad')
            ->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
