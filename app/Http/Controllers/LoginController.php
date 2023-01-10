<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'email' => "required|email",
            'password' => "required"
        ]);



        // comprobando si las credenciales son correctas
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)){
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        // si es correcta la autenticacion
        return redirect()->route('posts.index', auth()->user()->username);
    }

}
