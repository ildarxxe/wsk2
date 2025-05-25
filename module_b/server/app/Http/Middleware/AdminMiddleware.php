<?php

namespace App\Http\Middleware;

use App\Models\Token;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        $user_id = Token::query()->where('token', $token)->first()->user_id;
        $user = User::query()->find($user_id);

        if ($user->role_id === 2) {
            return $next($request);
        }
        return response()->json(['Message' => 'Access only for admin'], 403);
    }
}
