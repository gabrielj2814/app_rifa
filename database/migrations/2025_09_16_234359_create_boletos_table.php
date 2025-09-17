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
        Schema::create('boletos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rifa_id')->constrained('rifas')->cascadeOnDelete();
            $table->string('numero', 20);
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('estado',["disponible","no_disponible"])->default('disponible');
            $table->timestamps();

            $table->unique(['rifa_id', 'numero']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boletos');
    }
};
