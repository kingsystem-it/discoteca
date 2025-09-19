@extends('layouts.app')
@section('content')
<div class="flex justify-between mb-4">
  <h1 class="text-xl font-semibold">Clientes</h1>
  <a href="/clientes/create" class="bg-black text-white px-3 py-2 rounded">Novo</a>
</div>
<div class="bg-white rounded-xl shadow overflow-hidden">
  <table class="w-full text-sm">
    <thead class="bg-gray-50"><tr><th class="p-2 text-left">Nome</th><th class="p-2 text-left">E-mail</th><th class="p-2 text-left">Telefone</th><th class="p-2 text-left">Data nasc.</th><th class="p-2">Ações</th></tr></thead>
    <tbody>
      @forelse($clientes as $c)
        <tr class="border-t">
          <td class="p-2">{{ $c->nome }}</td>
          <td class="p-2">{{ $c->email }}</td>
          <td class="p-2">{{ $c->telefone }}</td>
          <td class="p-2">{{ optional($c->data_nascimento)->format('d/m/Y') }}</td>
          <td class="p-2"><a class="text-blue-600" href="/clientes/{{ $c->id }}/edit">Editar</a></td>
        </tr>
      @empty
        <tr><td class="p-4" colspan="5">Nenhum cliente.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
