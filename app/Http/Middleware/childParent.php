<?php

namespace App\Http\Middleware;

use App\Models\Children;
use Closure;
use Illuminate\Http\Request;

class childParent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $children = Children::findOrFail($request->baby);
        $parents = $children->Partners->pluck('id')->toArray();
        if(in_array(auth()->user()->id,$parents)){
            return $next($request);
        }else{
            return response()->json('Authorization Error');
            exit;
        }

    }
}
