<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::orderByDesc('data_inicio')->get();
        return view('eventos.index', compact('eventos'));
    }

    public function create() { return view('eventos.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:160',
            'local' => 'nullable|string|max:200',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'capacidade' => 'required|integer|min:1',
        ]);
        Evento::create($data + ['ativo' => true]);
        return redirect('/eventos')->with('status','Evento criado.');
    }

    public function edit(Evento $evento)
    { return view('eventos.edit', compact('evento')); }

    public function update(Request $request, Evento $evento)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:160',
            'local' => 'nullable|string|max:200',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'capacidade' => 'required|integer|min:1',
        ]);
        $evento->update($data);
        return redirect('/eventos')->with('status','Evento atualizado.');
    }
}
