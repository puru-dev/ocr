<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //echo Auth::user()->role;exit;
        if(Auth::user()->role==1){
            //return redirect()->route('employee.show', [Auth::user()->id]);
            //echo  Auth::user()->id;exit;
            //return redirect()->route('employee');
            //return Redirect::to('employee');
            return $next($request);
            
        }
        return redirect()->route('employee.show', [Auth::user()->id]);
        
        //abort(403);
        
    }
}
