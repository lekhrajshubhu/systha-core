<?php

namespace Systha\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Systha\Core\Models\TenantCustomer;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class CustomerJwtAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $payload = JWTAuth::parseToken()->getPayload();

            $customerId = $payload->get('customer_id');
            if (!$customerId) {
                return response()->json(['message' => 'Token missing customer context.'], 401);
            }

            $customer = TenantCustomer::find($customerId);

            if (!$customer) {
                return response()->json(['message' => 'Customer not found.'], 401);
            }

            if ($customer->status !== 'active') {
                return response()->json(['message' => 'Customer account is inactive.'], 403);
            }

            $request->setUserResolver(static fn () => $customer);
            $request->merge(['customer' => $customer]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Token is invalid or expired.'], 401);
        }

        return $next($request);
    }
}
