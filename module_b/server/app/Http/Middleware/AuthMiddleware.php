<?php

namespace App\Http\Middleware;

use App\Models\Token;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        $user_id = Token::query()->where('token', $token)->first()->user_id ?? null;
        if (!$user_id) {
            return response()->json(['Message' => 'Unauthorized user']);
        }
        $user = User::query()->find($user_id);
        $request->setUserResolver(function () use ($user) {
            return $user;
        });
        return $next($request);
    }
}
