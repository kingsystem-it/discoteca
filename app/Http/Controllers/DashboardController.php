<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Ingresso;
use App\Models\Checkin;
use App\Models\ComandaItem;
use App\Models\Pagamento;

class DashboardController extends Controller
{
    public function index()
    {
        $hoje = Carbon::today();
        $kpis = [
            'ingressos_vendidos' => Ingresso::whereDate('created_at', $hoje)->count(),
            'checkins' => Checkin::whereDate('created_at', $hoje)->count(),
            'vendas_bar' => Pagamento::whereDate('created_at', $hoje)->sum('valor'),
            'ticket_medio' => ComandaItem::whereDate('created_at', $hoje)
                ->selectRaw('COALESCE(SUM(qtd*preco_unit)/NULLIF(COUNT(DISTINCT comanda_id),0),0) as tm')
                ->value('tm') ?? 0,
        ];
        return view('dashboard', compact('kpis'));
    }
}
