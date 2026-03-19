<?php

namespace Systha\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Systha\Core\Models\TenantMember;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class TenantJwtAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $payload = JWTAuth::parseToken()->getPayload();

            $memberId = $payload->get('member_id');
            if (!$memberId) {
                return response()->json(['message' => 'Token missing tenant member context.'], 401);
            }

            $user = TenantMember::find($memberId);

            if (!$user) {
                return response()->json(['message' => 'Tenant member not found.'], 401);
            }

            if (!$user->is_active || $user->status !== 'active') {
                return response()->json(['message' => 'Member account is inactive.'], 403);
            }

            $request->setUserResolver(static fn () => $user);
            $request->merge(['member' => $user]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Token is invalid or expired.'], 401);
        }

        return $next($request);
    }
}
