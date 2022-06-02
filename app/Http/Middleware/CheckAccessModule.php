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
        // If user not super admin
        if (Auth::user()->role_id != 1) {

            // If module code have many and use & as separator
            $array_and = explode("&", $module_code);
            if (\count($array_and) > 1) {
                // Normaly allows is true
                $allows = TRUE;

                foreach ($array_and as $code) {
                    // Check allow module
                    $check_allows = Gate::allows("check-module", $code);

                    // If have a not authorize module, set allows to false
                    if (!$check_allows) {
                        $allows = FALSE;
                    }
                }

                // If all modules is allow
                if ($allows) {
                    return $next($request);
                }
            }

            // If module code many and use | as separator
            $array_or = explode("|", $module_code);
            if (\count($array_or) > 1) {
                // Normaly allows is false
                $allows = FALSE;

                foreach ($array_or as $code) {
                    // Check allow module
                    $check_allows = Gate::allows("check-module", $code);

                    // If have a authorize module, set allows to true
                    if ($check_allows) {
                        $allows = TRUE;
                        break;
                    }
                }

                // If have allows module
                if ($allows) {
                    return $next($request);
                }
            }

            // If module code not have separator, then check in gates
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
