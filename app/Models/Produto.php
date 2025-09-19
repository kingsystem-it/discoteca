<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
        'categoria_id',
        'nome',
        'custo',
        'preco',
        'estoque_atual',
        'ativo',
        'imagem_path',
    ];

    protected $casts = [
        'custo'          => 'decimal:2',
        'preco'          => 'decimal:2',
        'estoque_atual'  => 'integer',
        'ativo'          => 'boolean',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    // (opcional) helper para URL da imagem
    public function getImagemUrlAttribute(): ?string
    {
        return $this->imagem_path ? asset('storage/'.$this->imagem_path) : null;
    }
}
