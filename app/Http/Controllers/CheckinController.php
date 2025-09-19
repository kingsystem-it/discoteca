<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ingresso;
use App\Models\Checkin;

class CheckinController extends Controller
{
    public function index()
    {
        $ultimos = Checkin::latest()->limit(10)->get();
        return view('checkin.index', compact('ultimos'));
    }

    public function scan(Request $request)
    {
        $data = $request->validate(['qr_code' => 'required|string|max:64']);
        $qr = $data['qr_code'];
        $ingresso = Ingresso::where('qr_code', $qr)->first();
        if (!$ingresso) {
            return back()->withErrors(['qr_code' => 'Ingresso inválido']);
        }
        if ($ingresso->estado === 'cancelado') {
            return back()->withErrors(['qr_code' => 'Ingresso cancelado']);
        }
        if ($ingresso->checkin()->exists()) {
            return back()->withErrors(['qr_code' => 'Ingresso já utilizado']);
        }
        Checkin::create([
            'ingresso_id' => $ingresso->id,
            'operador_id' => Auth::id() ?? 1,
            'dispositivo' => $request->userAgent(),
        ]);
        $ingresso->update(['estado' => 'checkin']);
        return back()->with('status', 'Check-in realizado.');
    }
}
