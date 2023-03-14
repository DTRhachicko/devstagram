<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comentario'
    ];

    //Obtener usuario que escribio el comentario
    public function user()
    {
        //se crea una relacion del comentario con el usuario, comentario pertenece a usuario
        return $this->belongsTo(User::class);
    }
}
