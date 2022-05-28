<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

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
            // return response()->json([
            //     'success' => false,
            //     'message' => "Hey Admin, You must login to access"
            // ]);
            // if($request->routeIs('admin.*')){
            //     return response()->json([
            //         'success' => false,
            //         'message' => "Hey Admin, You must login to access"
            //     ]);

            // }else{
            //     return response()->json([
            //         'success' => false,
            //         'message' => "You must login to access"
            //     ]);
            // }
        }
    }
}
