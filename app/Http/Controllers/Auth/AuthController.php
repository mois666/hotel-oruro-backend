<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Models\PermissionRole;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(AuthLoginRequest $request)
    {
        $credentials = $request->validated();
        //si ya existe una sesion activa
        if (Auth::check()) {
            return response()->json([
                'message' => 'Ya existe una sesión activa'
            ], 422);
        }

        if ( !Auth::attempt( $credentials ) )
        {
            return response()->json([
                'message' => 'Correo o contraseña inválidos'
            ], 422);
        }
        $user = User::find(Auth::user()->id);
        $token = $user->createToken('token')->plainTextToken;
        /* Obtener los roles del usuario de assignment */
        $roles = [];
        $roles = [$user->role];
        /* Obtener los permisos del usuario de assignment */
        $permissions = [];

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'avatar' => $user->avatar,
                'email' => $user->email,
                'roles' => $roles,
                'permissions' => $permissions,
            ],
            'token' => $token,
        ]);
    }


    public function logout( Request $request )
    {
        $token = $request->user()->currentAccessToken();

        $token->delete();

        return response()->json([
            "message" => "La sesion se cerró correctamente"
        ]);
    }

    public function checkAuthToken(Request $request){

        try {
            $user = $request->user();
            return response()->json([
                "user" => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Unauthenticated."
            ]);
        }

    }

    public function createToken(Request $request){

        $token = PersonalAccessToken::create([
            "id" => $request->id,
            "tokenable_type" => User::class,
            "tokenable_id" => $request->tokenable_id,
            "name" => $request->name,
            "token" => $request->token,
            "abilities" => ["*"],
            "last_used_at" => now(),
        ]);

        return $token;
    }

    public function deleteToken($id){

        $token = PersonalAccessToken::find($id);
        if ($token) {
            $token->delete();
            return response()->json([
                "message" => "Token eliminado exitosamente."
            ], 200);
        }

        return response()->json([
            "message" => "Token no encontrado."
        ], 404);
    }
}
