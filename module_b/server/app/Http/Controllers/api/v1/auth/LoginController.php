<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Http\Controllers\Controller;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $username = $request->input('name');
        $password = $request->input('password');

        try {
            $user = User::query()->where('name', $username)->first();
            if (!$user) {
                return response()->json(['status' => false, 'err_msg' => 'user not found']);
            }
            if (!Hash::check($password, $user->password)) {
                return response()->json(['status' => false, 'err_msg' => 'wrong password']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'err_msg' => $th->getMessage()]);
        }

        $token = $user->getToken(); // token or null
        if ($token === null) {
            $token = Token::query()->create([
                'user_id' => $user->id,
                'token' => Str::random(30),
            ]);
        }
        if ($token === "") {
            $token = Token::query()->where('user_id', $user->id)->first();
            $token->update([
                'token' => Str::random(30),
            ]);
            $token->save();
        }

        $role = $user->getRole();
        return response()->json(['status' => true, 'token' => $token->token ?? $token, 'role' => $role]);
    }
}
