<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Request;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (Request::is('/admin*'))
                return route('admin.login.page');
            if (Request::is('/vendor*'))
                return route('vendor.login.page');
            if (Request::is('/customer*'))
                return route('customer.login.page');
        }
    }
}
