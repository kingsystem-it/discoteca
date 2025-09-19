<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $fillable = ['nome','email','senha_hash','ativo'];
    protected $hidden = ['senha_hash','remember_token'];
    protected $casts = ['ativo' => 'boolean'];

    public function getAuthPassword() { return $this->senha_hash; }

    public function roles() { return $this->belongsToMany(Role::class, 'usuario_role'); }
}
