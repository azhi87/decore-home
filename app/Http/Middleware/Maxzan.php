<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Carbon\Carbon;
use DB;
class Maxzan
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
        if(Auth::user()->type!='admin' &&  Auth::user()->type!='accountant' && Auth::user()->type!='supervisor' && Auth::user()->type!='maxzan')
        {
           $text="ناتوانیت سەردانی ئەم بەشە بکەیت";
            \Session::flash('message', $text);
            \Session::flash('type','error');
            DB::table('illegal_operations')->insert([
                'user_id'=>Auth::user()->id,
                'description'=>'Access restricted accountant_high Pages',  
                'created_at'=>Carbon::now()
                ]);
           return back();
        }
        return $next($request);
    }
}
