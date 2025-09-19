<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Checkin extends Model
{
    use HasFactory;
    protected $table = 'checkins';
    protected $fillable = ['ingresso_id','operador_id','dispositivo'];

    public function ingresso(): BelongsTo { return $this->belongsTo(Ingresso::class, 'ingresso_id'); }
    public function operador(): BelongsTo { return $this->belongsTo(Usuario::class, 'operador_id'); }
}
