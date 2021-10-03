<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseBuilder
{
    public static function success($data = null, ?string $message = ''): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'locale' => app()->getLocale(),
            'message' => $message,
            'result' => $data,
        ], 200);
    }
}
