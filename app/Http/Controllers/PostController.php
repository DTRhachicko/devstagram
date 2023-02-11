<?php

namespace App\Http\Controllers;

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
        return view('dashboard', [
                'user' => $user
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }
}
