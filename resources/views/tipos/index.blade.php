@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-2">Tipos de ingresso — {{ $evento->nome }}</h1>
<form method="POST" action="/eventos/{{ $evento->id }}/tipos" class="bg-white p-4 rounded-xl shadow mb-4 grid md:grid-cols-4 gap-3">
  @csrf
  <input name="nome" placeholder="Nome (pista/VIP)" class="border rounded p-2" required>
  <input type="number" step="0.01" name="preco" placeholder="Preço" class="border rounded p-2" required>
  <input type="number" name="quantidade" placeholder="Quantidade" class="border rounded p-2" required>
  <button class="bg-black text-white rounded px-3">Adicionar</button>
</form>
<div class="bg-white rounded-xl shadow overflow-hidden">
  <table class="w-full text-sm">
    <thead class="bg-gray-50"><tr><th class="p-2 text-left">Nome</th><th class="p-2 text-left">Preço</th><th class="p-2 text-left">Qtd</th></tr></thead>
    <tbody>
      @foreach($tipos as $t)
        <tr class="border-t"><td class="p-2">{{ $t->nome }}</td><td class="p-2">R$ {{ number_format($t->preco,2,',','.') }}</td><td class="p-2">{{ $t->quantidade }}</td></tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
