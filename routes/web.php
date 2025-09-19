<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\TipoIngressoController;
use App\Http\Controllers\IngressoController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\PDVController;
use App\Http\Controllers\RelatorioController;

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'attempt'])->name('login.attempt')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protegidas
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Eventos & Tipos
    Route::get('/eventos', [EventoController::class, 'index']);
    Route::get('/eventos/create', [EventoController::class, 'create']);
    Route::post('/eventos', [EventoController::class, 'store']);
    Route::get('/eventos/{evento}/edit', [EventoController::class, 'edit']);
    Route::put('/eventos/{evento}', [EventoController::class, 'update']);
    Route::get('/eventos/{evento}/tipos', [TipoIngressoController::class, 'index']);
    Route::post('/eventos/{evento}/tipos', [TipoIngressoController::class, 'store']);

    // Ingressos
    Route::get('/ingressos/vender', [IngressoController::class, 'venderForm']);
    Route::post('/ingressos', [IngressoController::class, 'store']);
    Route::get('/ingressos/{ingresso}', [IngressoController::class, 'show'])->name('ingresso.show');

    // Check-in
    Route::get('/checkin', [CheckinController::class, 'index']);
    Route::post('/checkin/scan', [CheckinController::class, 'scan']);

    // Clientes
    Route::get('/clientes', [ClienteController::class, 'index']);
    Route::get('/clientes/create', [ClienteController::class, 'create']);
    Route::post('/clientes', [ClienteController::class, 'store']);
    Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit']);
    Route::put('/clientes/{cliente}', [ClienteController::class, 'update']);

    // Produtos
    Route::get('/produtos', [ProdutoController::class, 'index']);
    Route::get('/produtos/create', [ProdutoController::class, 'create']);
    Route::post('/produtos', [ProdutoController::class, 'store']);
    Route::get('/produtos/{produto}/edit', [ProdutoController::class, 'edit']);
    Route::put('/produtos/{produto}', [ProdutoController::class, 'update']);

   // PDV
Route::get('/pdv', [PDVController::class, 'index']);
Route::post('/comandas', [PDVController::class, 'abrir']);
Route::post('/comandas/{comanda}/itens', [PDVController::class, 'addItem']);

//remover item da comanda (enquanto estiver aberta)
Route::post(
    '/comandas/{comanda}/itens/{item}/remover',
    [PDVController::class, 'removerItem']
)->name('comanda.item.remover');

Route::post('/comandas/{comanda}/fechar', [PDVController::class, 'fechar']);

    // Relatórios
    Route::get('/relatorios/diario', [RelatorioController::class, 'diario']);
});

Route::get('/health', fn()=> ['ok'=>true,'ts'=>now()->toDateTimeString()]);
