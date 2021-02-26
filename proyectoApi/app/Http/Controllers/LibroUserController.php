<?php

namespace App\Http\Controllers;

//use App\User;
use App\User;
use App\Libro;
use App\LibroUser;
use Illuminate\Http\Request;

class LibroUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Libro $libro)
    {
        //Muestra todos los usuaros a los que se han prestado libros
        return $libro->users;
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prestamos = LibroUser::all()->pluck('user_id');

        /*dd((json_decode(json_encode($prestamos), true)));
        dd(array_search(32, json_decode(json_encode($prestamos), true)));
        
        dd(array_search($request->input('user_id'), (array)$prestamos));*/
     
        if(array_search($request->input('user_id'), json_decode(json_encode($prestamos), true))){
            return response()->json([
                'message'=>'El usuario ya tiene este libro'], 401);
        }

        //Realizamos el préstamo
        $prestamo = LibroUser::create($request->all());
        return response()->json([
            'data'=>$prestamo,
            'message'=>'Préstamo realizado correctamente'], 200);
    } 

    public function destroy(Libro $libro, User $user)
    {
     
        //ELiminar un prestamo
        //Primero comprobamos si el libro indicado está prestado al usuaro indicado
        //En caso negativo enviamos mensaje
        if(!$libro->users()->find($user->id)){
            return response()->json([
                
                'message'=>'El usuario indicado no tiene prestado este libro'], 404);
        }

        //Eliminamos el préstamo
        $libro->users()->detach($user->id);
        return response()->json([
            'message'=>'Préstamo eliminado correctamente'], 200);
    }
    
}
