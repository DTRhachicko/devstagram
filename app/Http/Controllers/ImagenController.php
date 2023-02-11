<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        //$input = $request -> all();
        $imagen = $request -> file('file');

        //Str:uuid genera un id unico para cada una de las imagenes
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        //recortar imagen
        $imagenServidor = Image::make($imagen);
        $imagenServidor -> fit(1000, 1000);

        //psoicionar en el servidor
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor -> save($imagenPath);

        //aqui se imprime lo que se muestra en consola en el navegador
        return response() -> json(['imagen' => $nombreImagen]);
    }
}
