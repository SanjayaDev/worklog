<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;

class CheckAccessModule
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $module_code)
    {
        if (Auth::user()->role_id != 1) {
            $array_and = explode("&", $module_code);
            if (\count($array_and) > 1) {
                $allows = TRUE;

                foreach ($array_and as $code) {
                    $check_allows = Gate::allows("check-module", $code);
                    if (!$check_allows) {
                        $allows = FALSE;
                    }
                }

                if ($allows) {
                    return $next($request);
                }
            }

            $array_or = explode("|", $module_code);
            if (\count($array_or) > 1) {
                $allows = FALSE;

                foreach ($array_or as $code) {
                    $check_allows = Gate::allows("check-module", $code);
                    if ($check_allows) {
                        $allows = TRUE;
                    }
                }

                if ($allows) {
                    return $next($request);
                }
            }

            $check_allows = Gate::allows("check-module", $module_code);
            if ($check_allows) {
                return $next($request);
            }
            Alert::error("Gagal!", "Anda tidak di izinkan mengakses halaman ini!");
            return back();
        } 

        return $next($request);
    }
}
