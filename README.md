# Discoteca MVP — Laravel (Fase 1)

Este pacote contém **migrations, models, controllers, views, rotas e auth** para um MVP de discoteca (ingressos + comandas).

## Como usar
1. Crie um projeto Laravel 10/11 (`laravel new projeto` ou `composer create-project laravel/laravel projeto`).
2. Copie o conteúdo destas pastas para dentro do seu projeto (mesma estrutura).
3. Configure o `.env` (DB, APP_URL etc.).
4. `composer install` (se ainda não fez) e `php artisan key:generate`.
5. Rode as migrations: `php artisan migrate`.
6. Crie um usuário admin:
   ```php
   php artisan tinker
   App\Models\Usuario::create([
     'nome'=>'Gerente',
     'email'=>'admin@local',
     'senha_hash'=>Hash::make('admin123'),
     'ativo'=>true
   ]);
   ```
7. Opcional: crie métodos de pagamento (Dinheiro/Cartão/Pix) com seed ou via Tinker.
8. `php artisan serve` e acesse `http://127.0.0.1:8000/login` (admin@local / admin123).

## Observações
- `Ingresso::checkin()` é `hasOne` e `checkins.ingresso_id` é `unique` (1 uso por ticket).
- Venda de ingresso verifica **capacidade de evento** e **saldo do tipo** com `lockForUpdate()`.
- PDV baixa estoque automaticamente ao adicionar item.
- Rotas protegidas com `auth` (guard `web` usando `App\Models\Usuario`).

Qualquer dúvida, chama! 😉
