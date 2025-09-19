@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-4">Check-in</h1>
<div class="bg-white p-4 rounded-xl shadow grid md:grid-cols-3 gap-4">
  <div class="md:col-span-2">
    <label class="text-sm">QR / Código</label>
    <form method="POST" action="/checkin/scan" class="flex gap-2">
      @csrf
      <input name="qr_code" autofocus class="border rounded p-2 w-full" placeholder="Escaneie ou digite o código">
      <button class="bg-black text-white px-4 rounded">Validar</button>
    </form>
    <p class="text-xs text-gray-500 mt-2">(Opcional) Integrar scanner JS como html5-qrcode no app.js.</p>
  </div>
  <div>
    <div class="rounded border p-3">
      <div class="text-sm text-gray-500">Últimos check-ins</div>
      <ul class="text-sm mt-2 space-y-1">
        @foreach($ultimos as $u)
          <li>Ingresso #{{ $u->ingresso_id }} — {{ $u->created_at->format('H:i:s') }}</li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
@endsection
