<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    //Campos rellenables
    protected $fillable = [
        'title', 'description',
    ];

    //Campos ocultos
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    //Función que permite obtener a qué usuario se les ha prestado qué libros
    public function users()
    {
        return $this->belongsToMany(User::class, 'libro_users');
    }
    

}
