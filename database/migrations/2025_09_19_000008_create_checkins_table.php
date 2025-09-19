<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('checkins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ingresso_id')->unique();
            $table->unsignedBigInteger('operador_id');
            $table->string('dispositivo', 80)->nullable();
            $table->timestamps();

            $table->foreign('ingresso_id')->references('id')->on('ingressos')->onDelete('cascade');
            $table->foreign('operador_id')->references('id')->on('usuarios');
        });
    }
    public function down(): void { Schema::dropIfExists('checkins'); }
};
