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
        Schema::create('premios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rifa_id')->constrained('rifas')->cascadeOnDelete();
            $table->string('descripcion');
            $table->decimal('valor_estimado', 10, 2)->nullable();
            $table->string('posicion', 50)->nullable();
            $table->timestamps();

            $table->unique(['rifa_id', 'posicion']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premios');
    }
};
