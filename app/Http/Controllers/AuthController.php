<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

//https://youtu.be/sa3u4Nyrjcg
class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Credenciais incorretas.'],
            ]);
        }

        return response()->json([
            'data' => [
                'token' => $user->createToken($request->device_name)->plainTextToken,
            ],
        ]);
    }

    public function logout(Request $request)
    {
        $request
            ->user()
            ->tokens()
            ->delete();
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'is_admin' => 'required|boolean|min:1',
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'is_admin' => $validatedData['is_admin'],
        ]);

        return response()->noContent(Response::HTTP_CREATED);
    }
    public function selectAllUsers()
    {
        $usuarios = User::all();
        return $usuarios;
    }
    public function destroy(User $id_user)
    {
        $id_user->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
