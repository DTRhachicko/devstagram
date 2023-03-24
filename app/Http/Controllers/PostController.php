<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //
    public function __construct()
    {
        //los middleware se ejecutan primero que los metodos
        //esta funcion verifica que el usuario este autenticado, para acceder a los metodos de esta clase
        $this -> middleware('auth')->except(['show', 'index']);//except recibe los metodos que no requieren autenticación de usuario para mostrarse
    }

    public function index(User $user)
    {
        //dd(auth()->user());
        //dd($user -> username);
        //obtener posts del perfil del usuario en el que estamos
        //latest ordena del ultimo registro al primero
        $posts = Post::where('user_id', $user->id)->latest()->paginate(10);
        //dd($posts);

        return view('dashboard', [
                'user' => $user,
                'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        //dd('creando publicación ...');
        $this -> validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        /*Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);*/

        //opcion 2 de alamcenar datos
        /*$post = new Post;
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;
        $post->save();*/

        //opcion 3 de alamcenar datos -  Con relaciones
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        //Eliminar la Imagen
        $imagen_path = public_path('uploads/' . $post->imagen);

        if (File::exists($imagen_path)) 
        {
            unlink($imagen_path);//elimina la imagen
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
