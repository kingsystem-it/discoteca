<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $fillable = ['nome','email','telefone','data_nascimento','consentimento_marketing'];
    protected $casts = [
        'data_nascimento' => 'date',
        'consentimento_marketing' => 'boolean',
    ];

    public function comandas(): HasMany { return $this->hasMany(Comanda::class); }
    public function ingressos(): HasMany { return $this->hasMany(Ingresso::class); }
}
