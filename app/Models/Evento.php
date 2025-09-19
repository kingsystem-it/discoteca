<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evento extends Model
{
    use HasFactory;
    protected $table = 'eventos';
    protected $fillable = ['nome','data_inicio','data_fim','capacidade','local','ativo'];
    protected $casts = [
        'data_inicio' => 'datetime',
        'data_fim' => 'datetime',
        'ativo' => 'boolean',
    ];

    public function tipos(): HasMany { return $this->hasMany(TipoIngresso::class, 'evento_id'); }
    public function ingressos(): HasMany { return $this->hasMany(Ingresso::class, 'evento_id'); }
}
