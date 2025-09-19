@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-4">Novo produto</h1>
<form method="POST" action="/produtos">
  @csrf
  <div class="grid md:grid-cols-3 gap-4 bg-white p-4 rounded-xl shadow">
    <div>
      <label class="text-sm">Nome</label>
      <input name="nome" class="w-full border rounded p-2" required>
    </div>
    <div>
      <label class="text-sm">Preço</label>
      <input type="number" step="0.01" name="preco" class="w-full border rounded p-2" required>
    </div>
    <div>
      <label class="text-sm">Estoque inicial</label>
      <input type="number" name="estoque_atual" class="w-full border rounded p-2" required>
    </div>
    <div class="md:col-span-3 flex justify-end">
      <button class="bg-black text-white px-4 py-2 rounded">Salvar</button>
    </div>
  </div>
</form>
@endsection
