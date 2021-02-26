<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserLibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        //Muestra los libros  prestados a los usuarios
        $libros = $user->libros;
        return $libros;
    }
}
