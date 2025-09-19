<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pagamento extends Model
{
    use HasFactory;
    protected $table = 'pagamentos';
    protected $fillable = ['comanda_id','metodo_id','valor'];
    protected $casts = [ 'valor' => 'decimal:2' ];

    public function comanda(): BelongsTo { return $this->belongsTo(Comanda::class, 'comanda_id'); }
    public function metodo(): BelongsTo { return $this->belongsTo(MetodoPagamento::class, 'metodo_id'); }
}
