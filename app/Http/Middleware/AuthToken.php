<?php

namespace App\Http\Middleware;

use App\Models\Auth\Usertoken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class AuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = data_get($request , 'token');
       $user_token = Usertoken::is_token_exist($token);
       if(!empty($user_token)) {
        $user = $user_token->user;
        $request->merge(['user_data' => $user]);
        return $next($request);
       } else {
        throw new Exception("Token expired");
       }
    }
}
