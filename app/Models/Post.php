<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    //relacion Belongs to
    public function user()
    {
        return $this->belongsTo(User::class)->select(['name', 'username']);

        //En caso de no seguir las convenciones de Laravel, la relación se pasaría de la siguiente forma
        //return $this->belongsTo(User::class, 'user_id')->select(['name', 'username']);
    }

    //Mostrar comentarios
    public function comentarios()
    {
        //relacion para mostrar comentarios, un post tiene multiples comentarios
        return $this->hasMany(Comentario::class);
    }
}
