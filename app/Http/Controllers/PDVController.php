<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\MetodoPagamento;
use App\Models\Comanda;
use App\Models\ComandaItem;
use App\Models\Pagamento;

class PDVController extends Controller
{
    public function index(Request $request)
    {
        $clientes = Cliente::orderBy('nome')->get();
        $produtos = Produto::where('ativo', true)->orderBy('nome')->get();
        $metodos  = MetodoPagamento::orderBy('nome')->get();

        $comanda = null;
        $itens   = collect();
        if ($request->has('comanda_id')) {
            $comanda = Comanda::find($request->get('comanda_id'));
            if ($comanda) {
                $itens = $comanda->itens()->with('produto')->get();
            }
        }

        return view('pdv.comanda', compact('clientes','produtos','metodos','comanda','itens'));
    }

    public function abrir(Request $request)
    {
        $data = $request->validate([
            'cliente_id'   => 'nullable|exists:clientes,id',
            'identificador'=> 'nullable|string|max:60',
        ]);

        $comanda = Comanda::create($data + ['status' => 'aberta']);

        return redirect()->to('/pdv?comanda_id='.$comanda->id)
            ->with('status','Comanda aberta.');
    }

    public function addItem(Request $request, Comanda $comanda): RedirectResponse
{
    abort_if($comanda->status !== 'aberta', 400, 'Comanda não está aberta');

    $data = $request->validate([
        'produto_id' => 'required|exists:produtos,id',
        'qtd'        => 'required|integer|min:1',
    ]);

    $produto = Produto::findOrFail($data['produto_id']);
    $qt      = (int) $data['qtd'];

    return DB::transaction(function () use ($comanda, $produto, $qt, $data) {
        $ok = \App\Models\Produto::where('id', $produto->id)
            ->where('estoque_atual', '>=', $qt)
            ->decrement('estoque_atual', $qt);

        if ($ok === 0) {
            $saldo = \App\Models\Produto::where('id', $produto->id)->value('estoque_atual');
            return back()->withErrors([
                'qtd' => 'Estoque insuficiente para '.$produto->nome.' (disponível: '.$saldo.')'
            ])->withInput();
        }

        \App\Models\ComandaItem::create([
            'comanda_id' => $comanda->id,
            'produto_id' => $produto->id,
            'qtd'        => $qt,
            'preco_unit' => $produto->preco,
        ]);

        return back()->with('status','Item adicionado.');
    });
}

    public function removerItem(Request $request, Comanda $comanda, ComandaItem $item): RedirectResponse
    {
        abort_if($comanda->status !== 'aberta', 400, 'Comanda não está aberta');
        abort_if($item->comanda_id !== $comanda->id, 404);

        DB::transaction(function () use ($item) {
            $devolver = (int) ceil((float) $item->qtd);
            $item->produto->increment('estoque_atual', $devolver);
            $item->delete();
        });

        return back()->with('status', 'Item removido.');
    }

    public function fechar(Request $request, Comanda $comanda)
    {
        abort_if($comanda->status !== 'aberta', 400, 'Comanda não está aberta');

        $metodos = MetodoPagamento::pluck('id');
        $val     = $request->get('pagamentos', []);

        $total = $comanda->itens()
            ->selectRaw('SUM(qtd*preco_unit) as t')
            ->value('t') ?? 0;

        $soma = 0;
        foreach ($val as $metodoId => $valor) {
            if (!in_array((int) $metodoId, $metodos->toArray())) continue;
            $soma += (float) $valor;
        }

        if (round($soma, 2) + 0.00001 < round($total, 2)) {
            return back()->withErrors(['pagamentos' => 'Total pago inferior ao devido']);
        }

        DB::transaction(function () use ($val, $comanda) {
            foreach ($val as $metodoId => $valor) {
                $v = (float) $valor; if ($v <= 0) continue;
                Pagamento::create([
                    'comanda_id' => $comanda->id,
                    'metodo_id'  => (int) $metodoId,
                    'valor'      => $v,
                ]);
            }
            $comanda->update(['status' => 'fechada', 'fechado_em' => now()]);
        });

        return redirect('/pdv')->with('status','Comanda fechada.');
    }
}
