<?php

namespace Systha\Core\Http\Concerns;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait HandlesApiResources
{
    protected function perPage(Request $request): int
    {
        $perPage = (int) $request->input('per_page', 15);
        if ($perPage < 1) {
            return 15;
        }

        return min($perPage, 100);
    }

    protected function search(Request $request): ?string
    {
        $search = trim((string) $request->input('search', ''));

        return $search === '' ? null : $search;
    }

    protected function paginatedResponse(LengthAwarePaginator $paginator): JsonResponse
    {
        return response()->json([
            'data' => $paginator->items(),
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'last_page' => $paginator->lastPage(),
            ],
        ]);
    }
}
