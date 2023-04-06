<?php

namespace App\Http\Middleware;

use App\Models\Auth\Usertoken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\throwException;

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
       if(!empty($token)){
        $user = $user_token->user;
        $request->merge(['partner_user',$user]);
        return $next($request);
       } else {
        throwException("Invalid token");
       }
        dd($user_token->user);
        return $next($request);
    }
}
