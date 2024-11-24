<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClienteAuthController extends Controller
{
    public function showLogin()
    {
        return view('client.login_cliente');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('cliente')->attempt($credentials)) {
            return redirect()->intended('catalogo');
        }

        return back()->withErrors(['email' => 'Las credenciales no coinciden']);
    }

    public function showRegister()
    {
        return view('client.registro_cliente');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'ci' => 'required|unique:clientes',
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email|unique:clientes',
            'celular' => 'required|unique:clientes',
            'direccion' => 'required',
            'password' => 'required|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);
        Cliente::create($data);

        return redirect()->route('cliente.login')->with('status', 'Registro exitoso, ahora puedes iniciar sesión');
    }


    public function logout()
    {
        Auth::guard('cliente')->logout();
        return redirect()->intended('catalogo');
    }
}
