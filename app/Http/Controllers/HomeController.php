<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        //Evita eu un usuario no autenticado acceda a la vista de la página o cualquier metodo de esta clase
        $this->middleware('auth');
    }

    public function __invoke()
    {
        //Obtener a quienes eguimos
        //pluck recibe como parametros los campos que queremos ver la tabla que se consulta, en este caso solo queremos los IDs
        //toArray, convierte el resultado en un arreglo.
        
        $ids = auth()->user()->following->pluck('id')->toArray();
        

        //como se pasa un arreglo, se usa whereIn, que buscará los posts donde el id del usuario sea igual a los ids de los que seguimos
        //latest ordena del ultimo registro al primero
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(10);
        //dd($posts);

        return view('home', [
            'posts' => $posts
        ]);
    }
}
