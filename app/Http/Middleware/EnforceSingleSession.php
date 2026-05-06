<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class EnforceSingleSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $sessionId = $request->session()->getId();

            // Aseguramos que la sesión actual esté vinculada al usuario en la DB.
            // Esto garantiza que la limpieza desde Login.php funcione correctamente.
            DB::table('sessions')
                ->where('id', $sessionId)
                ->update(['user_id' => $user->id]);

            // Verificamos si la sesión actual del usuario sigue existiendo en la DB.
            // Si no existe, es porque otro inicio de sesión la eliminó.
            $exists = DB::table('sessions')
                ->where('id', $sessionId)
                ->where('user_id', $user->id)
                ->exists();

            if (!$exists) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')->with('status', 'Tu sesión ha sido cerrada porque se inició sesión en otro dispositivo.');
            }
        }

        return $next($request);
    }
}
