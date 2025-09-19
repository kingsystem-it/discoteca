@extends('layouts.app')
@section('content')
<div class="flex justify-between mb-4">
  <h1 class="text-xl font-semibold">Eventos</h1>
  <a href="/eventos/create" class="bg-black text-white px-3 py-2 rounded">Novo evento</a>
</div>
<div class="bg-white rounded-xl shadow overflow-hidden">
  <table class="w-full text-sm">
    <thead class="bg-gray-50">
      <tr>
        <th class="text-left p-2">Nome</th>
        <th class="text-left p-2">Início</th>
        <th class="text-left p-2">Fim</th>
        <th class="text-left p-2">Capacidade</th>
        <th class="text-left p-2">Ações</th>
      </tr>
    </thead>
    <tbody>
      @forelse($eventos as $e)
        <tr class="border-t">
          <td class="p-2">{{ $e->nome }}</td>
          <td class="p-2">{{ $e->data_inicio }}</td>
          <td class="p-2">{{ $e->data_fim }}</td>
          <td class="p-2">{{ $e->capacidade }}</td>
          <td class="p-2 flex gap-2">
            <a class="text-blue-600" href="/eventos/{{ $e->id }}/edit">Editar</a>
            <a class="text-indigo-600" href="/eventos/{{ $e->id }}/tipos">Tipos</a>
            <a class="text-emerald-700" href="/ingressos/vender?evento_id={{ $e->id }}">Vender</a>
          </td>
        </tr>
      @empty
        <tr><td class="p-4" colspan="5">Nenhum evento.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
