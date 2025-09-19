<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComandaItem extends Model
{
    use HasFactory;
    protected $table = 'comanda_itens';
    protected $fillable = ['comanda_id','produto_id','qtd','preco_unit'];
    protected $casts = [ 'qtd' => 'decimal:2', 'preco_unit' => 'decimal:2' ];

    public function comanda(): BelongsTo { return $this->belongsTo(Comanda::class, 'comanda_id'); }
    public function produto(): BelongsTo { return $this->belongsTo(Produto::class, 'produto_id'); }
}
