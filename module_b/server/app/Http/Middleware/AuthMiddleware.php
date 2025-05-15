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
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        $tokenRec = Token::query()->where('token', $token)->first();
        if (!$tokenRec) {
            return response()->json(['Message' => 'Unauthorized user'], 401);
        }
        $user = User::query()->find((int)$tokenRec->user_id);
        if (!$user) {
            return response()->json(['Message' => 'Unauthorized user'], 401);
        }
        $request->setUserResolver(function () use ($user) {
            return $user;
        });
        return $next($request);
    }
}
