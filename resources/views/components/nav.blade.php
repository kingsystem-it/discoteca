<nav class="bg-white shadow">
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex justify-between h-14 items-center">
      <a href="/" class="font-semibold">🎧 Discoteca</a>
      <ul class="flex gap-4 text-sm items-center">
        <li><a href="/" class="hover:underline">Dashboard</a></li>
        <li><a href="/eventos" class="hover:underline">Eventos</a></li>
        <li><a href="/checkin" class="hover:underline">Check-in</a></li>
        <li><a href="/pdv" class="hover:underline">PDV</a></li>
        <li><a href="/clientes" class="hover:underline">Clientes</a></li>
        <li><a href="/produtos" class="hover:underline">Produtos</a></li>
        <li><a href="/relatorios/diario" class="hover:underline">Relatórios</a></li>
        @auth
          <li>
            <form method="POST" action="{{ route('logout') }}" class="inline">
              @csrf
              <button class="hover:underline">Sair</button>
            </form>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
