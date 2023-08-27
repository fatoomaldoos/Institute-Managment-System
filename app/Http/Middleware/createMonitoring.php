<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Traits\User_roles;
use App\Traits\userAuthorizations;
use Tymon\JWTAuth\Facades\JWTAuth;

class createMonitoring
{
    use User_roles,userAuthorizations;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $HR= $this->isHR();
        $createMonitoring = $this->createMonitoring();
        $manager = $this->isManager();
        if($HR||$createMonitoring||$manager)
        {
            return $next($request);
        }
        return response (["message"=>"ليس لديك صلاحيات"]);

    }
}
