<?php

namespace Modules\DreamPaladin\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class Auth
{

    public function handle($request, Closure $next): Response | JsonResponse
    {
        if ($request->hasHeader('Authorization')) {
            return $next($request);
        }
        return response()->json([
            'status' => ResponseAlias::HTTP_UNAUTHORIZED,
            'error' => 'Bạn phải đăng nhập để vào truy cập'
        ]);
    }
}
