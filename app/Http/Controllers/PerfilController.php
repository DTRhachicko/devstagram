<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        //Evita eu un usuario no autenticado acceda a la vista de la página o cualquier metodo de esta clase
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        //Modificar el Request
        $request -> request->add(['username' => Str::slug($request -> username)]);
        
        $this->validate($request, [
            //para evitar que detecte el id del mismo usuario se pondra en la validacion del usuario, la columna y el id que queremos que ignore
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil']
        ]);

        if($request->imagen) 
        {
           //$input = $request -> all();
            $imagen = $request -> file('imagen');

            //Str:uuid genera un id unico para cada una de las imagenes
            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            //recortar imagen
            $imagenServidor = Image::make($imagen);
            $imagenServidor -> fit(1000, 1000);

            //psoicionar en el servidor
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor -> save($imagenPath);
        }

        //Guardar cambios
        $usuario = User::find(auth()->user()->id);

        $usuario->username = $request->username;

        //primero verifica si hay imagen, si la ahay le asigna la ruta, sino, le asigna un campo vacio
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? ''; //si hay imagen la asiga o de lo contrario lo deja vacio
        $usuario->save();

        //Redireccionar al usuario
        return redirect()->route('posts.index', $usuario->username);
    }
}
