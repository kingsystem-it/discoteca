@extends('layouts.app')
@section('content')
<div class="grid md:grid-cols-4 gap-4">
  <div class="bg-white rounded-xl p-4 shadow">
    <div class="text-xs text-gray-500">Ingressos vendidos (hoje)</div>
    <div class="text-2xl font-bold">{{ $kpis['ingressos_vendidos'] ?? 0 }}</div>
  </div>
  <div class="bg-white rounded-xl p-4 shadow">
    <div class="text-xs text-gray-500">Check-ins (hoje)</div>
    <div class="text-2xl font-bold">{{ $kpis['checkins'] ?? 0 }}</div>
  </div>
  <div class="bg-white rounded-xl p-4 shadow">
    <div class="text-xs text-gray-500">Vendas bar (R$)</div>
    <div class="text-2xl font-bold">{{ number_format($kpis['vendas_bar'] ?? 0,2,',','.') }}</div>
  </div>
  <div class="bg-white rounded-xl p-4 shadow">
    <div class="text-xs text-gray-500">Ticket médio</div>
    <div class="text-2xl font-bold">{{ number_format($kpis['ticket_medio'] ?? 0,2,',','.') }}</div>
  </div>
</div>
@endsection
