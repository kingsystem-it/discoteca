<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('comanda_itens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comanda_id');
            $table->unsignedBigInteger('produto_id');
            $table->decimal('qtd', 10, 2)->default(1);
            $table->decimal('preco_unit', 10, 2);
            $table->timestamps();

            $table->foreign('comanda_id')->references('id')->on('comandas')->onDelete('cascade');
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->index('comanda_id');
        });
    }
    public function down(): void { Schema::dropIfExists('comanda_itens'); }
};
