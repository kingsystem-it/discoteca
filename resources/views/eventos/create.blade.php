@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-4">Novo evento</h1>
<form method="POST" action="/eventos">
  @csrf
  <div class="grid md:grid-cols-2 gap-4 bg-white p-4 rounded-xl shadow">
    <div>
      <label class="text-sm">Nome</label>
      <input name="nome" class="w-full border rounded p-2" required>
    </div>
    <div>
      <label class="text-sm">Local</label>
      <input name="local" class="w-full border rounded p-2">
    </div>
    <div>
      <label class="text-sm">Início</label>
      <input type="datetime-local" name="data_inicio" class="w-full border rounded p-2" required>
    </div>
    <div>
      <label class="text-sm">Fim</label>
      <input type="datetime-local" name="data_fim" class="w-full border rounded p-2" required>
    </div>
    <div>
      <label class="text-sm">Capacidade</label>
      <input type="number" name="capacidade" class="w-full border rounded p-2" required>
    </div>
    <div class="md:col-span-2 flex justify-end">
      <button class="bg-black text-white px-4 py-2 rounded">Salvar</button>
    </div>
  </div>
</form>
@endsection
