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
        Schema::create('ganadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rifa_id')->constrained('rifas')->cascadeOnDelete();
            $table->foreignId('boleto_id')->constrained('boletos')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('premio');
            $table->dateTime('fecha_registro')->nullable();
            $table->timestamps();

            $table->unique(['rifa_id', 'boleto_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ganadores');
    }
};
