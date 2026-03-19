<?php

namespace Systha\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Systha\Core\Models\Tenant;
use Systha\Core\Models\TenantMember;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class TenantContextFromToken
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $payload = JWTAuth::parseToken()->getPayload();

            $tenantId = $payload->get('tenant_id');
            $memberId = $payload->get('member_id');
            $tenantCode = $payload->get('tenant_code');
            $role = $payload->get('role');

            if (!$tenantId || !$memberId) {
                return response()->json(['error' => 'Invalid token payload: missing tenant/member context'], 401);
            }

            $tenant = Tenant::where('id', $tenantId)
                ->where('status', 'active')
                ->first();

            if (!$tenant) {
                return response()->json(['error' => 'Tenant is inactive or not found'], 403);
            }

            $member = TenantMember::where('id', $memberId)
                ->where('tenant_id', $tenantId)
                ->where('status', 'active')
                ->where('is_active', true)
                ->first();

            if (!$member) {
                return response()->json(['error' => 'Member is inactive or not found'], 403);
            }

            $request->merge([
                'tenant' => $tenant,
                'member' => $member,
                'role' => $role,
                'tenant_code' => $tenantCode,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token is invalid or expired'], 401);
        }

        return $next($request);
    }
}
