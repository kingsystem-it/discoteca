<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // categoria_id
        if (!Schema::hasColumn('produtos', 'categoria_id')) {
            Schema::table('produtos', function (Blueprint $table) {
                $table->foreignId('categoria_id')->nullable()
                      ->constrained('categorias')->nullOnDelete();
            });
        }

        // imagem_path
        if (!Schema::hasColumn('produtos', 'imagem_path')) {
            Schema::table('produtos', function (Blueprint $table) {
                $table->string('imagem_path')->nullable()->after('preco');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('produtos', 'categoria_id')) {
            Schema::table('produtos', function (Blueprint $table) {
                $table->dropForeign(['categoria_id']);
                $table->dropColumn('categoria_id');
            });
        }

        if (Schema::hasColumn('produtos', 'imagem_path')) {
            Schema::table('produtos', function (Blueprint $table) {
                $table->dropColumn('imagem_path');
            });
        }
    }
};
