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
        Schema::create('rifas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->integer('total_boletos');
            $table->text('descripcion')->nullable();
            $table->decimal('precio_boleto', 10, 2);
            $table->dateTime('fecha_inicio')->nullable();
            $table->dateTime('fecha_fin')->nullable();
            $table->dateTime('fecha_sorteo')->nullable();
            $table->enum('estado',["inactivo","activa"])->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rifas');
    }
};
