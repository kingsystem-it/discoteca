@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-4">Ingresso #{{ $ingresso->id }}</h1>
<div class="bg-white p-4 rounded-xl shadow space-y-2">
  <div><b>Evento:</b> {{ $ingresso->evento->nome }}</div>
  <div><b>Tipo:</b> {{ $ingresso->tipo->nome }}</div>
  <div><b>Estado:</b> {{ strtoupper($ingresso->estado) }}</div>
  <div><b>QR:</b> <code>{{ $ingresso->qr_code }}</code></div>
</div>
@endsection
