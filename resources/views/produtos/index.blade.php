@extends('layouts.app')
@section('content')
<div class="flex justify-between mb-4">
  <h1 class="text-xl font-semibold">Produtos</h1>
  <a href="/produtos/create" class="bg-black text-white px-3 py-2 rounded">Novo</a>
</div>
<div class="bg-white rounded-xl shadow overflow-hidden">
  <table class="w-full text-sm">
    <thead class="bg-gray-50"><tr><th class="p-2 text-left">Nome</th><th class="p-2 text-left">Preço</th><th class="p-2 text-left">Estoque</th><th class="p-2">Ações</th></tr></thead>
    <tbody>
      @forelse($produtos as $p)
        <tr class="border-t">
          <td class="p-2">{{ $p->nome }}</td>
          <td class="p-2">R$ {{ number_format($p->preco,2,',','.') }}</td>
          <td class="p-2">{{ $p->estoque_atual }}</td>
          <td class="p-2"><a class="text-blue-600" href="/produtos/{{ $p->id }}/edit">Editar</a></td>
        </tr>
      @empty
        <tr><td class="p-4" colspan="4">Nenhum produto.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
