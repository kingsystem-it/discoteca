@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-4">Vender ingresso</h1>
<form method="POST" action="/ingressos">
  @csrf
  <div class="grid md:grid-cols-2 gap-4 bg-white p-4 rounded-xl shadow">
    <div>
      <label class="text-sm">Evento</label>
      <select name="evento_id" class="w-full border rounded p-2" required>
        @foreach($eventos as $e)
          <option value="{{ $e->id }}" @selected(request('evento_id')==$e->id)>{{ $e->nome }}</option>
        @endforeach
      </select>
    </div>
    <div>
      <label class="text-sm">Tipo de ingresso</label>
      <select name="tipo_ingresso_id" class="w-full border rounded p-2" required>
        @foreach($tipos as $t)
          <option value="{{ $t->id }}">{{ $t->nome }} — R$ {{ number_format($t->preco,2,',','.') }}</option>
        @endforeach
      </select>
    </div>
    <div>
      <label class="text-sm">Cliente (opcional)</label>
      <select name="cliente_id" class="w-full border rounded p-2">
        <option value="">—</option>
        @foreach($clientes as $c)
          <option value="{{ $c->id }}">{{ $c->nome }} ({{ $c->email }})</option>
        @endforeach
      </select>
    </div>
    <div class="md:col-span-2 flex justify-end">
      <button class="bg-black text-white px-4 py-2 rounded">Emitir</button>
    </div>
  </div>
</form>
<script>
  const eventoSelect = document.querySelector('select[name="evento_id"]');
  if (eventoSelect) {
    eventoSelect.addEventListener('change', function(){
      const id = this.value;
      const url = new URL(window.location.href);
      url.searchParams.set('evento_id', id);
      window.location.href = url.toString();
    });
  }
</script>
@endsection
