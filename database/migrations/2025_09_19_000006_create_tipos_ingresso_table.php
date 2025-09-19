<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tipos_ingresso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evento_id');
            $table->string('nome', 80);
            $table->decimal('preco', 10, 2);
            $table->integer('lote')->default(1);
            $table->integer('quantidade');
            $table->timestamps();

            $table->foreign('evento_id')->references('id')->on('eventos')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('tipos_ingresso'); }
};
