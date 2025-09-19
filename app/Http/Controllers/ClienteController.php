<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index()
    { $clientes = Cliente::orderBy('nome')->paginate(20); return view('clientes.index', compact('clientes')); }

    public function create()
    { return view('clientes.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:160',
            'email' => 'nullable|email|max:160|unique:clientes,email',
            'telefone' => 'nullable|string|max:40',
            'data_nascimento' => 'nullable|date',
            'consentimento_marketing' => 'nullable|boolean',
        ]);
        $data['consentimento_marketing'] = (bool)($data['consentimento_marketing'] ?? false);
        Cliente::create($data);
        return redirect('/clientes')->with('status','Cliente criado.');
    }

    public function edit(Cliente $cliente)
    { return view('clientes.edit', compact('cliente')); }

    public function update(Request $request, Cliente $cliente)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:160',
            'email' => 'nullable|email|max:160|unique:clientes,email,'.$cliente->id,
            'telefone' => 'nullable|string|max:40',
            'data_nascimento' => 'nullable|date',
            'consentimento_marketing' => 'nullable|boolean',
        ]);
        $data['consentimento_marketing'] = (bool)($data['consentimento_marketing'] ?? false);
        $cliente->update($data);
        return redirect('/clientes')->with('status','Cliente atualizado.');
    }
}
