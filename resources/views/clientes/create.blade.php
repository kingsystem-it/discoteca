@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-4">Novo cliente</h1>
<form method="POST" action="/clientes">
  @csrf
  <div class="grid md:grid-cols-2 gap-4 bg-white p-4 rounded-xl shadow">
    <div>
      <label class="text-sm">Nome</label>
      <input name="nome" class="w-full border rounded p-2" required>
    </div>
    <div>
      <label class="text-sm">E-mail</label>
      <input type="email" name="email" class="w-full border rounded p-2">
    </div>
    <div>
      <label class="text-sm">Telefone</label>
      <input name="telefone" class="w-full border rounded p-2">
    </div>
    <div>
      <label class="text-sm">Data de nascimento</label>
      <input type="date" name="data_nascimento" class="w-full border rounded p-2">
    </div>
    <div class="md:col-span-2">
      <label class="inline-flex items-center gap-2 text-sm"><input type="checkbox" name="consentimento_marketing" value="1"> Aceito receber comunicações</label>
    </div>
    <div class="md:col-span-2 flex justify-end">
      <button class="bg-black text-white px-4 py-2 rounded">Salvar</button>
    </div>
  </div>
</form>
@endsection
