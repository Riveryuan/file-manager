<?php

namespace Riveryuan\FileManager\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * FileManagerCheckLogin
 *
 * @package Riveryuan\FileManager\Middleware
 */
class FileManagerCheckLogin {

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        $login_user = $request->session()->get("fm_login_user_info");

        if (!$login_user || !isset($login_user['name'])) {
            return redirect('fm/');
        }

        return $next($request);
    }

}
