<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }

    public function attempt(Request $request)
    {
        $creds = $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);
        if (Auth::attempt(['email' => $creds['email'], 'password' => $creds['password']], true)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('status','Bem-vindo!');
        }
        return back()->withErrors(['email' => 'Credenciais inválidas'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
