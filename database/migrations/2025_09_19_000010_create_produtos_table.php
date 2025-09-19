<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->string('nome', 140);
            $table->string('sku', 60)->nullable();
            $table->decimal('custo', 10, 2)->default(0);
            $table->decimal('preco', 10, 2);
            $table->integer('estoque_atual')->default(0);
            $table->integer('estoque_minimo')->default(0);
            $table->boolean('ativo')->default(true);
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->index(['ativo','categoria_id']);
        });
    }
    public function down(): void { Schema::dropIfExists('produtos'); }
};
