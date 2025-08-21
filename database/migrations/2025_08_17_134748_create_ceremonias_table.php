<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ceremonias', function (Blueprint $table) {
            $table->id();
            $table->date('fec_ceremonia');
            $table->text('comentarios')->nullable();
            $table->unsignedBigInteger('parroquias_id');
            $table->unsignedBigInteger('sacerdotes_id');
            $table->timestamps();

            $table->foreign('parroquias_id')
            ->references('id')->on('parroquias')
            ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('sacerdotes_id')
            ->references('id')->on('sacerdotes')
            ->onDelete('restrict')->onUpdate('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ceremonias');
    }
};
