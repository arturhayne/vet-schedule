<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\AppointmentHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use VetSchedule\Application\CheckAvailableTimeQueryHandler;

class CheckAvailableTimeController extends Controller
{
    /**
     * @var CheckAvailableTimeQueryHandler
     */
    private $handler;

    /**
     * CheckAvailableTimeController constructor.
     * @param CheckAvailableTimeQueryHandler $handler
     */
    public function __construct(CheckAvailableTimeQueryHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @param string $startDateTime
     * @return JsonResponse
     */
    public function checkTime(string $startDateTime): JsonResponse
    {
        $result = $this->handler->execute($startDateTime);
        return new JsonResponse($result);
    }
}
