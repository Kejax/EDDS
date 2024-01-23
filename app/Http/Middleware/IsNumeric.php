<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsNumeric
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$numbers): Response
    {

        foreach ($numbers as $number) {
            $num = $request->route($number);
            if (!is_numeric($num)) {
                return response()->json([
                    'error' => 400,
                    'message' => "$number is not a valid numeric"
                ], 400);
            }
        }

        return $next($request);
    }
}
