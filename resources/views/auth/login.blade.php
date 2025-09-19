<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login — Discoteca</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 grid place-items-center">
  <form method="POST" action="{{ route('login.attempt') }}" class="bg-white p-6 rounded-xl shadow w-full max-w-sm">
    @csrf
    <h1 class="text-xl font-semibold mb-4">Entrar</h1>
    <label class="text-sm">E-mail</label>
    <input name="email" type="email" class="w-full border rounded p-2 mb-3" required>
    <label class="text-sm">Senha</label>
    <input name="password" type="password" class="w-full border rounded p-2 mb-4" required>
    <button class="w-full bg-black text-white rounded p-2">Entrar</button>
  </form>
</body>
</html>
