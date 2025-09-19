<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comanda extends Model
{
    use HasFactory;
    protected $table = 'comandas';
    protected $fillable = ['cliente_id','identificador','status','fechado_em'];
    protected $casts = [ 'fechado_em' => 'datetime' ];

    public function cliente(): BelongsTo { return $this->belongsTo(Cliente::class, 'cliente_id'); }
    public function itens(): HasMany { return $this->hasMany(ComandaItem::class, 'comanda_id'); }
    public function pagamentos(): HasMany { return $this->hasMany(Pagamento::class, 'comanda_id'); }
}
