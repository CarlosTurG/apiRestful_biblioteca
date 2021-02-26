<?php

namespace App\Http\Controllers;

use App\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Libro $libro)
    {
        //Consultar libros
        //Mostramos la lista de todos los libros
        $libro = Libro::all();
        return $libro;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validación
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        //Crear libro
        $libro = Libro::create($request->all());
        return response()->json([
            'data'=>$libro,
            'message'=>'Registro realizado correctamente'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $libro = Libro::all();

        //Comprobamos si existe el libro que estamos buscando
        if(!array_search($id, json_decode(json_encode($libro->pluck('id')), true))){
            return response()->json([
                'message'=>'El libro que busca no existe'], 401);
        }

        //Devuelve el libro según el id (parámetro)
        return $libro->find($id);
    }

}
