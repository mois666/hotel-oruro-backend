<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Files\FileStorage;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /* Path */
    private const FOLDER_PATH = 'hotel-oruro/users';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($request->password);
        $data['role'] = $request->role;
        $data['status'] = $request->status;

        if($request->avatar != null){
            $url = FileStorage::upload($request->avatar, $this::FOLDER_PATH);
            if ($url == 'Error33') {

                return response()->json(['message' => 'NO se subió su foto']);

            } else if (strpos($url, ',') !== false) {

                $imageArr = [];
                $imageArr = explode(',', $url);
                $data['avatar'] = $imageArr[1];
                $data['avatar_key'] = $imageArr[0];
            } else {
                $data['avatar'] = $url;
            }
        }
        $user = User::create($data);
        return response()->json([
            'message' => 'Usuario creado correctamente',
            'user' => $user
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $data = $request->validated();
        $user = User::find($id);
        $data['role'] = $request->role;
        $data['status'] = $request->status;
        if($request->avatar != null && $request->avatar != $user->avatar){
            FileStorage::delete($user->avatar, $user->avatar_key);
            $url = FileStorage::upload($request->avatar, $this::FOLDER_PATH);
            if ($url == 'Error33') {

                return response()->json(['message' => 'NO se subió su foto']);

            } else if (strpos($url, ',') !== false) {

                $imageArr = [];
                $imageArr = explode(',', $url);
                $data['avatar'] = $imageArr[1];
                $data['avatar_key'] = $imageArr[0];
            } else {
                $data['avatar'] = $url;
            }
        }
        $user->update($data);
        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            //'store' => $store
         ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /* El ultimo usuario no se puede eliminar */
        $user = User::all();
        if($user->count() == 1){
            return response()->json(['message' => 'No se puede eliminar el último usuario'], 400);
        }

        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'El usuario no existe'], 404);
        }
        try {
            $user->delete();
            FileStorage::delete($user->avatar, $user->avatar_key);
            return response()->json(['message' => 'Usuario eliminado correctamente']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el usuario'], 500);
        }
    }
    public function updateRole(Request $request, string $id)
    {
        $user = User::find($id);
        $user->role = $request->role;
        $user->status = $request->status;

        $user->save();
        return response()->json([
            'message' => 'Rol actualizado correctamente',
            'user' => $user
      ], 201);
    }
}
