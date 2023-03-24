<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user)
    {
        //$user->followers->create(); <- para relaciones comunes
        $user->followers()->attach(auth()->user()->id); // <- para relaciones con tablas pibote que relacionan la misma tabla más de una vez

        return back();
    }

    public function destroy(User $user)
    {
        //$user->followers->create(); <- para relaciones comunes
        $user->followers()->detach(auth()->user()->id); // <- para relaciones con tablas pibote que relacionan la misma tabla más de una vez

        return back();
    }
}
