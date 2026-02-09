<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateNumericId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $id = $request->route('id');
        
        if ($id !== null && (!is_numeric($id) || $id <= 0 || $id != (int)$id)) {
            return response()->json([
                'error' => 'El ID debe ser un número entero positivo'
            ], 400);
        }
        
        return $next($request);
    }
}
