<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;

class TipoIngressoController extends Controller
{
    public function index(Evento $evento)
    {
        $tipos = $evento->tipos()->orderBy('nome')->get();
        return view('tipos.index', compact('evento','tipos'));
    }

    public function store(Request $request, Evento $evento)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:80',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:1',
        ]);
        $evento->tipos()->create($data + ['lote' => 1]);
        return back()->with('status','Tipo de ingresso adicionado.');
    }
}
