<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('logs_auditoria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->string('acao', 80);
            $table->string('recurso', 80)->nullable();
            $table->unsignedBigInteger('recurso_id')->nullable();
            $table->string('ip', 45)->nullable();
            $table->string('user_agent', 200)->nullable();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->index(['recurso','recurso_id']);
        });
    }
    public function down(): void { Schema::dropIfExists('logs_auditoria'); }
};
