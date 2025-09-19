<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Evento;
use App\Models\TipoIngresso;
use App\Models\Ingresso;
use App\Models\Cliente;
use App\Models\Checkin;

class IngressoController extends Controller
{
    public function venderForm(Request $request)
    {
        $eventos = Evento::orderByDesc('data_inicio')->get();
        $eventoId = $request->get('evento_id', optional($eventos->first())->id);
        $tipos = $eventoId ? TipoIngresso::where('evento_id', $eventoId)->get() : collect();
        $clientes = Cliente::orderBy('nome')->limit(200)->get();
        return view('ingressos.vender', compact('eventos','tipos','clientes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'tipo_ingresso_id' => 'required|exists:tipos_ingresso,id',
            'cliente_id' => 'nullable|exists:clientes,id',
        ]);

        return DB::transaction(function () use ($data) {
            $evento = Evento::lockForUpdate()->find($data['evento_id']);
            $vendidos = Ingresso::where('evento_id', $evento->id)->count();
            if ($vendidos >= $evento->capacidade) {
                return back()->withErrors(['capacidade' => 'Capacidade esgotada.']);
            }
            // saldo por tipo
            $tipo = TipoIngresso::lockForUpdate()->find($data['tipo_ingresso_id']);
            $vendidosTipo = Ingresso::where('tipo_ingresso_id', $tipo->id)->count();
            if ($vendidosTipo >= $tipo->quantidade) {
                return back()->withErrors(['tipo_ingresso_id' => 'Quantidade esgotada para este tipo.']);
            }

            $qr = bin2hex(random_bytes(16));
            $ingresso = Ingresso::create([
                'evento_id' => $evento->id,
                'tipo_ingresso_id' => $data['tipo_ingresso_id'],
                'cliente_id' => $data['cliente_id'] ?? null,
                'qr_code' => $qr,
                'estado' => 'vendido',
            ]);
            return redirect()->route('ingresso.show', $ingresso)->with('status','Ingresso emitido.');
        });
    }

    public function show(Ingresso $ingresso)
    { return view('ingressos.show', compact('ingresso')); }
}
