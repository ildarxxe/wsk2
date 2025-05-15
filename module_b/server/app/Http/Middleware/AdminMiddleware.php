<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\Token;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        $user_id = Token::query()->where('token', $token)->first()->user_id;
        $user_role = Role::query()->where('user_id', $user_id)->first()->role;
        if ($user_role == 'admin') {
            return $next($request);
        }
        return response()->json(['status' => false, 'Message' => 'You are not authorized to access this page.'], 403);
    }
}
