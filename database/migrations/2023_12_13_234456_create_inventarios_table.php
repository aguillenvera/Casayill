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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->string("codigo")->nullable();
            $table->string("producto")->nullable();
            $table->string("marca")->nullable();
            $table->decimal("precio", 10, 2)->nullable();
            $table->string("talla")->nullable();
            $table->string("tipo")->nullable();
            $table->string("color")->nullable();
            $table->integer("cantidad")->nullable();
            $table->string("almacen")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};
