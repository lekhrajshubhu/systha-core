<?php

namespace Systha\Core\Support;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Carbon;
use RuntimeException;

class JwtService
{
    public function issueToken(AuthenticatableContract $user): array
    {
        $issuedAt = Carbon::now()->timestamp;
        $ttlMinutes = max(1, (int) config('systha_core.auth.jwt_ttl', config('adminpanel.auth.jwt_ttl', 120)));
        $expiresAt = Carbon::now()->addMinutes($ttlMinutes)->timestamp;

        $payload = [
            'iss' => (string) config('systha_core.auth.jwt_issuer', config('adminpanel.auth.jwt_issuer', 'adminpanel')),
            'sub' => (string) $user->getAuthIdentifier(),
            'iat' => $issuedAt,
            'nbf' => $issuedAt,
            'exp' => $expiresAt,
            'email' => $user->email,
            'name' => $user->name,
        ];

        return [
            'token' => $this->encode($payload),
            'expires_in' => $expiresAt - $issuedAt,
            'expires_at' => $expiresAt,
        ];
    }

    public function decodeToken(string $token): array
    {
        $parts = explode('.', $token);
        if (count($parts) !== 3) {
            throw new RuntimeException('Invalid token format.');
        }

        [$encodedHeader, $encodedPayload, $encodedSignature] = $parts;

        $expectedSignature = $this->base64UrlEncode(
            hash_hmac('sha256', $encodedHeader . '.' . $encodedPayload, $this->secret(), true),
        );

        if (!hash_equals($expectedSignature, $encodedSignature)) {
            throw new RuntimeException('Invalid token signature.');
        }

        $payloadJson = $this->base64UrlDecode($encodedPayload);
        $payload = json_decode($payloadJson, true);
        if (!is_array($payload)) {
            throw new RuntimeException('Invalid token payload.');
        }

        $now = Carbon::now()->timestamp;
        if (($payload['nbf'] ?? 0) > $now) {
            throw new RuntimeException('Token not active yet.');
        }

        if (($payload['exp'] ?? 0) < $now) {
            throw new RuntimeException('Token has expired.');
        }

        return $payload;
    }

    private function encode(array $payload): string
    {
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT',
        ];

        $encodedHeader = $this->base64UrlEncode(json_encode($header, JSON_THROW_ON_ERROR));
        $encodedPayload = $this->base64UrlEncode(json_encode($payload, JSON_THROW_ON_ERROR));
        $signature = hash_hmac('sha256', $encodedHeader . '.' . $encodedPayload, $this->secret(), true);
        $encodedSignature = $this->base64UrlEncode($signature);

        return $encodedHeader . '.' . $encodedPayload . '.' . $encodedSignature;
    }

    private function secret(): string
    {
        $secret = (string) config('systha_core.auth.jwt_secret', config('adminpanel.auth.jwt_secret', ''));
        if ($secret !== '') {
            return $secret;
        }

        $appKey = (string) config('app.key', '');
        if (str_starts_with($appKey, 'base64:')) {
            $decoded = base64_decode(substr($appKey, 7), true);
            if ($decoded !== false && $decoded !== '') {
                return $decoded;
            }
        }

        if ($appKey !== '') {
            return $appKey;
        }

        throw new RuntimeException('JWT secret is not configured.');
    }

    private function base64UrlEncode(string $value): string
    {
        return rtrim(strtr(base64_encode($value), '+/', '-_'), '=');
    }

    private function base64UrlDecode(string $value): string
    {
        $remainder = strlen($value) % 4;
        if ($remainder > 0) {
            $value .= str_repeat('=', 4 - $remainder);
        }

        $decoded = base64_decode(strtr($value, '-_', '+/'), true);
        if ($decoded === false) {
            throw new RuntimeException('Invalid base64 token section.');
        }

        return $decoded;
    }
}
