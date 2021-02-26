<?php

namespace App\Http\Controllers;

use App\User;
use App\Helpers\Token;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
	{
		$this->middleware('auth')->except('store','login');
	}

	public function login(Request $request)
    {
        $user = User::by_field('email', $request->email);

		if (isset($user) && Hash::check($request->password, $user->password))
        {
            $token = new Token(['email' => $user->email]);
            $token = $token->encode();

            return response()->json([
                "token" => $token
            ], 200);
        }

        return response()->json([
            "message" => "no autorizado"
        ], 401);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Consultar usuarios
        //Mostramos la lista de todos los usuarios
        $users = User::all();
        return $users;
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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        //dd($validatedData['password']);
        $validatedData['password'] = bcrypt($validatedData['password']);


        //Token jwt
        $data_token = [
            "email" => $validatedData['email'],
        ];
        $token = new Token($data_token);
        $token = $token->encode();

        //Registramos/creamos un nuevo usuario
        $user = User::create($request->all());
        return response()->json([
            'data'=>$user,
            'message'=>'Registro realizado correctamente'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::all();

        //Comprobamos si existe el usuario que estamos buscando
        if(!array_search($id, json_decode(json_encode($user->pluck('id')), true))){
            return response()->json([
                'message'=>'El usuario que busca no se encuentra registrado'], 401);
        }

        //Devuelve el usuario según el id (parámetro)
        return $user->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Modificar/Actualizar usuarios
        $user = User::update($request->all());
        return response()->json([
            'data'=>$user,
            'message'=>'Actualización realizada correctamente'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //Eliminamos usuario
        $user->delete();
        return $this->showOne($user);
    }
}
