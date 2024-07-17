<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegistroRequest;

class AuthController extends Controller
{
    public function register(RegistroRequest $request) {
        $data = $request->validated();

        // Crear usuario
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        // Retornar respuesta
        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];
    }

    public function login(LoginRequest $request) {
        $data = $request->validated();

        // Revisar el password
        if (!Auth::attempt($data)) {
            return response([
               'errors' => ['Credenciales inválidas']
            ], 422);
        }
    }
    
    public function logout(Request $request) {

    }

}
