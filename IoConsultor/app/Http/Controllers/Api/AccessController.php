<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    //Función para atrapar pokemones
    public function access(Request $request){

        //Valida los datos del body. <---
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        //Selecciona el que el usuario exista en nuestra DB
        $user = User::where('email', $request->email)->first();

        //Valida que tanto el usuario y la contraseña existan y sean
        //correctas, de lo contrario responde un mensaje de error
        if(!$user || !Hash::check($request->password, $user->password) ){
            return response()->json([
                'message' => 'Las credenciales son incorrectas',
                401
            ]);
        }
        //Se crea/solicita a/en la aplicación el token de autenticación
        $token = $user->createToken('auth_token')->plainTextToken;

        //Return 200 con el token y el tipo de token en formato JSON
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
