<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ingressos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evento_id');
            $table->unsignedBigInteger('tipo_ingresso_id');
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->string('qr_code', 64)->unique();
            $table->enum('estado', ['vendido','checkin','cancelado'])->default('vendido');
            $table->timestamps();

            $table->index('evento_id');
            $table->index(['evento_id','tipo_ingresso_id']);
            $table->foreign('evento_id')->references('id')->on('eventos')->onDelete('cascade');
            $table->foreign('tipo_ingresso_id')->references('id')->on('tipos_ingresso');
            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }
    public function down(): void { Schema::dropIfExists('ingressos'); }
};
