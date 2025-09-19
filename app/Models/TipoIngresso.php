<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoIngresso extends Model
{
    use HasFactory;
    protected $table = 'tipos_ingresso';
    protected $fillable = ['evento_id','nome','preco','lote','quantidade'];
    protected $casts = [ 'preco' => 'decimal:2' ];

    public function evento(): BelongsTo { return $this->belongsTo(Evento::class, 'evento_id'); }
    public function ingressos(): HasMany { return $this->hasMany(Ingresso::class, 'tipo_ingresso_id'); }
}
