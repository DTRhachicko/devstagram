<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        //dd('autenticando...');
        $this -> validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth() -> attempt($request -> only('email', 'password'), $request -> remember)) 
        {
            //back hace que regreses a la página anterior, en este caso se regresa a donde se esta llenando el formulario y with es una manera de guardar en una session el resultado de una operacion en el controlador y despues mostrarla en el front end
            return back() -> with('mensaje', 'Credenciales Incorrectas');
        }

        return redirect() -> route('posts.index', auth() -> user() -> username);
    }
}
