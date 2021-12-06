<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CheckDateTimeResponse
{
    /**
     * @return JsonResponse
     */
    public static function createAvailableResponse(): JsonResponse
    {
        return response()->json(
            [
                'status'    => 'success',
                'message'   => 'The datetime_start is available.',
                'available' => true
            ],
            Response::HTTP_OK
        );
    }

    /**
     * @return JsonResponse
     */
    public static  function createNotAvailableResponse(): JsonResponse
    {
        return response()->json(
            [
                'status'    => 'success',
                'message'   => 'The datetime_start is not available.',
                'available' => false
            ],
            Response::HTTP_OK
        );
    }

    /**
     * @return JsonResponse
     */
    public static function createInvalidResponse(): JsonResponse
    {
        return response()->json(
            [
                'status'    => 'error',
                'message'   => 'The datetime_start is not valid.',
                'available' => false
            ],
            Response::HTTP_BAD_REQUEST
        );
    }
}
