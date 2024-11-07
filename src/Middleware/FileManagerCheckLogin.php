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

        if (!$login_user || !isset($login_user['is_login']) ||
            !isset($login_user['login_time']) || $login_user['is_login']!==true) {
            return redirect('fm/')->with('login_error','您还没有登录，请先登录。');
        }

        return $next($request);
    }

}
