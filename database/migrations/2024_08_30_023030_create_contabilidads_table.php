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
        Schema::create('contabilidads', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('monto', 10, 2);
            $table->date('fecha_deuda');
            $table->date('fecha_pago')->nullable();
            $table->string('estado')->default('pendiente');
            $table->text('descripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contabilidads');
    }
};
