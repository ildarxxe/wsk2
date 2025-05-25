<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::query()->where('username', $data['username'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'invalid login'], 401);
        }

        $role = Role::query()->where('id', $user->role_id)->first()->name;

        $token = Token::query()->where('user_id', $user->id)->first();
        if (!$token) {
            $token = Token::query()->create([
                'user_id' => $user->id,
                'token' => Str::random(30),
            ]);
            return response()->json(['token' => $token->token, 'role' => $role]);
        }
        if ($token->token === "") {
            $token->token = Str::random(30);
            $token->save();
            return response()->json(['token' => $token->token, 'role' => $role]);
        }
        return response()->json(['token' => $token->token, 'role' => $role]);
    }

    public function logout(Request $request): JsonResponse
    {
        $user_id = $request->user()->id;

        try {
            Token::query()->where('user_id', $user_id)->delete();
            return response()->json(['message' => 'logout success']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'logout fail']);
        }
    }
}
