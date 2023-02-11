<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //Test de paso de parametros
        // dd($request);
        // dd($request -> get('username'));

        //Validación opc 1
        /*$this -> validate($request, [
            'name' => ['required', 'min:3', 'max:20'],
        ]);*/

        //Modificar el Request
        $request -> request->add(['username' => Str::slug($request -> username)]);

        //Validación opc 2
        $this -> validate($request, [
            'name' => 'required|min:3|max:16',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',
        ]);
        
        User::create([
            'name' => $request -> name,
            'username' => $request->username,
            'email' => $request -> email,
            'password' => Hash::make($request -> password)
        ]);


        //Autenticar un usuario
        /*auth() -> attempt([
            'email' => $request -> email,
            'password' => $request -> password,
        ]);*/

        //Autenticar un usuario opcion 2
        auth() -> attempt($request -> only('email', 'password'));

        //Redirección
        return redirect() -> route('posts.index');

    }
}
