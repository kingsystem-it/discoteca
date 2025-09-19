<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'Painel' }} — Discoteca</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 text-gray-900">
  <div class="min-h-screen">
    @include('components.nav')
    <main class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
  {{-- Erros de validação --}}
  @if ($errors->any())
    <div class="mb-4 rounded-lg bg-red-100 p-3 text-red-800">
      <ul class="list-disc ml-4">
        @foreach ($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Mensagem de sucesso/aviso --}}
  @if (session('status'))
    <div class="mb-4 rounded-lg bg-green-100 p-3 text-green-800">
      {{ session('status') }}
    </div>
  @endif

  @yield('content')
</main>

  </div>
</body>
</html>
