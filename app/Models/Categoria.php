<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nome','slug','parent_id'];

    public function parent(){ return $this->belongsTo(Categoria::class,'parent_id'); }
    public function children(){ return $this->hasMany(Categoria::class,'parent_id'); }
    public function produtos(){ return $this->hasMany(Produto::class,'categoria_id'); }
}
