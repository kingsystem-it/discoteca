<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogAuditoria extends Model
{
    use HasFactory;
    protected $table = 'logs_auditoria';
    protected $fillable = ['usuario_id','acao','recurso','recurso_id','ip','user_agent'];

    public function usuario(): BelongsTo { return $this->belongsTo(Usuario::class, 'usuario_id'); }
}
