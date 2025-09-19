<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comanda_id');
            $table->unsignedBigInteger('metodo_id');
            $table->decimal('valor', 10, 2);
            $table->timestamps();

            $table->foreign('comanda_id')->references('id')->on('comandas')->onDelete('cascade');
            $table->foreign('metodo_id')->references('id')->on('metodos_pagamento');
        });
    }
    public function down(): void { Schema::dropIfExists('pagamentos'); }
};
