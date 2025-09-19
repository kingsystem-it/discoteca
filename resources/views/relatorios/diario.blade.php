@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-4">Relatório diário</h1>
<form method="GET" action="/relatorios/diario" class="bg-white p-4 rounded-xl shadow mb-4 flex gap-2 items-end">
  <div>
    <label class="text-sm">Data</label>
    <input type="date" name="data" value="{{ request('data') ?? now()->format('Y-m-d') }}" class="border rounded p-2">
  </div>
  <button class="bg-black text-white px-4 py-2 rounded">Gerar</button>
</form>
<div class="grid md:grid-cols-3 gap-4">
  <div class="bg-white p-4 rounded-xl shadow">
    <div class="text-xs text-gray-500">Ingressos vendidos</div>
    <div class="text-2xl font-bold">{{ $resumo['ingressos_vendidos'] ?? 0 }}</div>
  </div>
  <div class="bg-white p-4 rounded-xl shadow">
    <div class="text-xs text-gray-500">Check-ins</div>
    <div class="text-2xl font-bold">{{ $resumo['checkins'] ?? 0 }}</div>
  </div>
  <div class="bg-white p-4 rounded-xl shadow">
    <div class="text-xs text-gray-500">Vendas bar (R$)</div>
    <div class="text-2xl font-bold">{{ number_format($resumo['vendas_bar'] ?? 0,2,',','.') }}</div>
  </div>
</div>
@endsection
