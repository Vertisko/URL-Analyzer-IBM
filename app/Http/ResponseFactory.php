<?php


namespace App\Http;

use Illuminate\Http\JsonResponse;

/**
 * Class ResponseFactory
 * @package App\Http
 */
class ResponseFactory
{
    /**
     * @param $data
     * @param int $statusCode
     * @param array $headers
     * @return JsonResponse
     */
    public static function createSuccessfulResponse($data, int $statusCode = 200, array $headers = []): JsonResponse
    {
        return JsonResponse::create(["data" => $data], $statusCode, $headers);
    }

    /**
     * @param array $errors
     * @param int $statusCode
     * @param array $headers
     * @return JsonResponse
     */
    public static function createFailedResponse(array $errors, int $statusCode, array $headers = []): JsonResponse
    {
        return JsonResponse::create(["errors" => $errors], $statusCode, $headers);
    }
}
