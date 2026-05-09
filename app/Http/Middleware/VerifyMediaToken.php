<?php
// app/Http/Middleware/VerifyMediaToken.php

namespace App\Http\Middleware;

use App\Models\Media;
use Closure;
use Illuminate\Http\Request;

class VerifyMediaToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('X-Media-Token') ?? $request->get('token');
        
        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Token manquant'
            ], 401);
        }
        
        $media = Media::where('media_token', $token)
            ->where('statut', 'validé')
            ->first();
        
        if (!$media) {
            return response()->json([
                'success' => false,
                'message' => 'Token invalide ou média non validé'
            ], 401);
        }
        
        $request->merge(['media' => $media]);
        $request->setUserResolver(function () use ($media) {
            return $media->user;
        });
        
        return $next($request);
    }
}