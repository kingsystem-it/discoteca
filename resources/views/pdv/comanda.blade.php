@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-4">PDV — Comanda</h1>
<form method="POST" action="/comandas" class="bg-white p-4 rounded-xl shadow mb-4">
  @csrf
  <div class="flex gap-2 items-end">
    <div class="flex-1">
      <label class="text-sm">Cliente (opcional)</label>
      <select name="cliente_id" class="w-full border rounded p-2">
        <option value="">—</option>
        @foreach($clientes as $c)
          <option value="{{ $c->id }}">{{ $c->nome }}</option>
        @endforeach
      </select>
    </div>
    <div>
      <label class="text-sm">Identificador</label>
      <input name="identificador" placeholder="cartão/pulseira" class="border rounded p-2">
    </div>
    <button class="bg-black text-white px-4 h-10 rounded">Abrir comanda</button>
  </div>
</form>

@if(isset($comanda))
<div class="grid md:grid-cols-3 gap-4">
  <div class="md:col-span-2 bg-white p-4 rounded-xl shadow">
    <h2 class="font-semibold mb-3">Itens da comanda #{{ $comanda->id }}</h2>
    <form method="POST" action="/comandas/{{ $comanda->id }}/itens" class="flex gap-2 mb-3">
      @csrf
      <select name="produto_id" class="border rounded p-2">
        @foreach($produtos as $p)
          <option value="{{ $p->id }}">{{ $p->nome }} — R$ {{ number_format($p->preco,2,',','.') }}</option>
        @endforeach
      </select>
      <input type="number" step="0.5" min="0.5" name="qtd" value="1" class="border rounded p-2 w-24">
      <button class="bg-black text-white px-4 rounded">Adicionar</button>
    </form>

    <table class="w-full text-sm">
      <thead class="bg-gray-50">
  <tr>
    <th class="p-2 text-left">Produto</th>
    <th class="p-2 text-right">Qtd</th>
    <th class="p-2 text-right">Preço</th>
    <th class="p-2">Ações</th>
  </tr>
</thead>
      <tbody>
        @php($total = 0)
        @foreach($itens as $i)
          @php($linha = $i->qtd * $i->preco_unit)
          @php($total += $linha)
          <tr class="border-t">
            <td class="p-2">{{ $i->produto->nome }}</td>
            <td class="p-2 text-right">{{ $i->qtd }}</td>
            <td class="p-2 text-right">R$ {{ number_format($linha,2,',','.') }}</td>
            <td class="p-2 text-center">
  <form method="POST" action="{{ route('comanda.item.remover', [$comanda->id, $i->id]) }}" class="inline">
    @csrf
    <button class="text-red-600 hover:underline" onclick="return confirm('Remover este item?')">Remover</button>
  </form>
</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="bg-white p-4 rounded-xl shadow">
    <h2 class="font-semibold mb-3">Fechamento</h2>
    <div class="text-2xl font-bold mb-3">Total: R$ {{ number_format($total,2,',','.') }}</div>
    <form method="POST" action="/comandas/{{ $comanda->id }}/fechar" class="space-y-2">
      @csrf
      @foreach($metodos as $m)
        <div class="flex items-center gap-2">
          <label class="w-28 text-sm">{{ $m->nome }}</label>
          <input type="number" step="0.01" name="pagamentos[{{ $m->id }}]" class="border rounded p-2 w-full" placeholder="0,00">
        </div>
      @endforeach
      <button class="w-full bg-emerald-600 text-white rounded p-2">Fechar comanda</button>
    </form>
  </div>
</div>
@endif
@endsection
