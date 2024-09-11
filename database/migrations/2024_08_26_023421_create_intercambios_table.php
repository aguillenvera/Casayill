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
        Schema::create('intercambios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->decimal('valor_intercambio', 10, 2); // Valor del intercambio en moneda
            $table->string('producto_intercambiado');
            $table->timestamps();
        });

        Schema::create('intercambio_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intercambio_id')->constrained()->onDelete('cascade');
            $table->foreignId('inventario_id')->constrained('inventarios')->onDelete('cascade');
            $table->integer('cantidad');
            $table->decimal('valor_producto', 10, 2); // Valor del producto en el intercambio
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intercambios');
    }
};
