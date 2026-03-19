<?php

namespace Systha\Core\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RuntimeException;
use Systha\Core\Models\Admin;
use Systha\Core\Support\JwtService;
use Symfony\Component\HttpFoundation\Response;

class AdminPanelJwtAuth
{
    public function __construct(private readonly JwtService $jwtService)
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        $token = $this->extractToken($request);
        if ($token === null) {
            return $this->unauthorized('Missing bearer token.');
        }

        try {
            $payload = $this->jwtService->decodeToken($token);
        } catch (RuntimeException $exception) {
            return $this->unauthorized($exception->getMessage());
        }

        $user = $this->resolveUser($payload['sub'] ?? null);
        if ($user === null) {
            return $this->unauthorized('User not found.');
        }

        $request->setUserResolver(static fn () => $user);
        $request->attributes->set('adminpanel_jwt_payload', $payload);

        return $next($request);
    }

    private function extractToken(Request $request): ?string
    {
        $header = (string) $request->header('Authorization', '');
        if (preg_match('/^Bearer\s+(.+)$/i', $header, $matches) === 1) {
            return trim($matches[1]);
        }

        return null;
    }

    private function resolveUser(mixed $identifier): mixed
    {
        if ($identifier === null || $identifier === '') {
            return null;
        }

        $userModel = (string) config('systha_core.auth.user_model', config('adminpanel.auth.user_model', Admin::class));
        if (!class_exists($userModel)) {
            return null;
        }

        return $userModel::query()
            ->whereKey($identifier)
            ->where('is_active', true)
            ->first();
    }

    private function unauthorized(string $message): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], 401);
    }
}
