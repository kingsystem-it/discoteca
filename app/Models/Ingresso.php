<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ingresso extends Model
{
    use HasFactory;
    protected $table = 'ingressos';
    protected $fillable = ['evento_id','tipo_ingresso_id','cliente_id','qr_code','estado'];

    public function evento(): BelongsTo { return $this->belongsTo(Evento::class, 'evento_id'); }
    public function tipo(): BelongsTo { return $this->belongsTo(TipoIngresso::class, 'tipo_ingresso_id'); }
    public function cliente(): BelongsTo { return $this->belongsTo(Cliente::class, 'cliente_id'); }
    public function checkin() { return $this->hasOne(Checkin::class, 'ingresso_id'); }
}
