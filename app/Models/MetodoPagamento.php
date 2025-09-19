<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MetodoPagamento extends Model
{
    use HasFactory;
    protected $table = 'metodos_pagamento';
    protected $fillable = ['nome'];

    public function pagamentos(): HasMany { return $this->hasMany(Pagamento::class, 'metodo_id'); }
}
