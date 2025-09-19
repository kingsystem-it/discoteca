<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('comandas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->string('identificador', 60)->nullable();
            $table->enum('status', ['aberta','fechada','cancelada'])->default('aberta');
            $table->timestamps();
            $table->dateTime('fechado_em')->nullable();

            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }
    public function down(): void { Schema::dropIfExists('comandas'); }
};
