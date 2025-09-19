<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index()
    { $produtos = Produto::orderBy('nome')->paginate(20); return view('produtos.index', compact('produtos')); }

    public function create()
    { return view('produtos.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:140',
            'preco' => 'required|numeric|min:0',
            'estoque_atual' => 'required|integer|min:0',
        ]);
        Produto::create($data + ['custo' => 0, 'ativo' => true]);
        return redirect('/produtos')->with('status','Produto criado.');
    }

    public function edit(Produto $produto)
    { return view('produtos.edit', compact('produto')); }

    public function update(Request $request, Produto $produto)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:140',
            'preco' => 'required|numeric|min:0',
            'estoque_atual' => 'required|integer|min:0',
        ]);
        $produto->update($data);
        return redirect('/produtos')->with('status','Produto atualizado.');
    }
}
