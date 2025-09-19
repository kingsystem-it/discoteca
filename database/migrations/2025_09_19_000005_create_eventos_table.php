<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 160);
            $table->dateTime('data_inicio');
            $table->dateTime('data_fim');
            $table->integer('capacidade');
            $table->string('local', 200)->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('eventos'); }
};
