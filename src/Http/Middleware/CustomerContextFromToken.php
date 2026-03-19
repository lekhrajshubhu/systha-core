<?php

namespace Systha\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Systha\Core\Models\Tenant;
use Systha\Core\Models\TenantCustomer;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class CustomerContextFromToken
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $payload = JWTAuth::parseToken()->getPayload();

            $tenantId = $payload->get('tenant_id');
            $customerId = $payload->get('customer_id');
            $tenantCode = $payload->get('tenant_code');
            $role = $payload->get('role');

            if (!$tenantId || !$customerId) {
                return response()->json(['error' => 'Invalid token payload: missing tenant/customer context'], 401);
            }

            $tenant = Tenant::where('id', $tenantId)
                ->where('status', 'active')
                ->first();

            if (!$tenant) {
                return response()->json(['error' => 'Tenant is inactive or not found'], 403);
            }

            $customer = TenantCustomer::where('id', $customerId)
                ->where('tenant_id', $tenantId)
                ->where('status', 'active')
                ->first();

            if (!$customer) {
                return response()->json(['error' => 'Customer is inactive or not found'], 403);
            }

            $request->merge([
                'tenant' => $tenant,
                'customer' => $customer,
                'role' => $role,
                'tenant_code' => $tenantCode,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token is invalid or expired'], 401);
        }

        return $next($request);
    }
}
