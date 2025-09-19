@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-4">Editar cliente</h1>
<form method="POST" action="/clientes/{{ $cliente->id }}">
  @csrf @method('PUT')
  <div class="grid md:grid-cols-2 gap-4 bg-white p-4 rounded-xl shadow">
    <div>
      <label class="text-sm">Nome</label>
      <input name="nome" value="{{ $cliente->nome }}" class="w-full border rounded p-2" required>
    </div>
    <div>
      <label class="text-sm">E-mail</label>
      <input type="email" name="email" value="{{ $cliente->email }}" class="w-full border rounded p-2">
    </div>
    <div>
      <label class="text-sm">Telefone</label>
      <input name="telefone" value="{{ $cliente->telefone }}" class="w-full border rounded p-2">
    </div>
    <div>
      <label class="text-sm">Data de nascimento</label>
      <input type="date" name="data_nascimento" value="{{ optional($cliente->data_nascimento)->format('Y-m-d') }}" class="w-full border rounded p-2">
    </div>
    <div class="md:col-span-2">
      <label class="inline-flex items-center gap-2 text-sm"><input type="checkbox" name="consentimento_marketing" value="1" @checked($cliente->consentimento_marketing)> Aceito receber comunicações</label>
    </div>
    <div class="md:col-span-2 flex justify-end">
      <button class="bg-black text-white px-4 py-2 rounded">Salvar</button>
    </div>
  </div>
</form>
@endsection
