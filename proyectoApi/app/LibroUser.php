<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibroUser extends Model
{
    protected $table = 'libro_users'; 

    //Campos rellenables
    protected $fillable = [
        'user_id', 'libro_id',
    ];

    //Campos ocultos
    protected $hidden = [
        //'created_at', 'updated_at',
    ];
}
