<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Ingresso;
use App\Models\Checkin;
use App\Models\Pagamento;

class RelatorioController extends Controller
{
    public function diario(Request $request)
    {
        $data = $request->get('data', Carbon::today()->format('Y-m-d'));
        $resumo = [
            'ingressos_vendidos' => Ingresso::whereDate('created_at', $data)->count(),
            'checkins' => Checkin::whereDate('created_at', $data)->count(),
            'vendas_bar' => Pagamento::whereDate('created_at', $data)->sum('valor'),
        ];
        return view('relatorios.diario', compact('resumo'));
    }
}
