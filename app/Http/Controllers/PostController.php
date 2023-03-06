<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function __construct()
    {
        //los middleware se ejecutan primero que el index
        $this -> middleware('auth');
    }

    public function index(User $user)
    {
        //dd(auth()->user());
        //dd($user -> username);
        //obtener posts del perfil del usuario en el que estamos
        $posts = Post::where('user_id', $user->id)->paginate(10);
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


}
