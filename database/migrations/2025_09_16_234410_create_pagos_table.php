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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('rifa_id')->constrained('rifas')->cascadeOnDelete();
            $table->foreignId('boleto_id')->constrained('boletos')->cascadeOnDelete();
            $table->decimal('monto', 10, 2);
            $table->enum('metodo_pago',["tarjeta","paypal","efectivo","pago móvil","binance"])->default('pago móvil');
            $table->enum('estado',["pendiente","cofirmado","cancelado"])->default('pendiente');
            $table->text('descripcion')->nullable();
            $table->dateTime('fecha_pago')->nullable();
            $table->timestamps();

            $table->unique('boleto_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
