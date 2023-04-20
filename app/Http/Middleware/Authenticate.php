<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     *
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // 中文翻译：如果请求是ajax请求，返回null，否则返回登录页面的路由
        return $request->expectsJson() ? null : route('login');
    }
}
