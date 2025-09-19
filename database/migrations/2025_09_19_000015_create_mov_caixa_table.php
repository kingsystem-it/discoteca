<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('mov_caixa', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['suprimento','sangria']);
            $table->decimal('valor', 10, 2);
            $table->unsignedBigInteger('usuario_id');
            $table->string('observacao', 200)->nullable();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios');
        });
    }
    public function down(): void { Schema::dropIfExists('mov_caixa'); }
};
