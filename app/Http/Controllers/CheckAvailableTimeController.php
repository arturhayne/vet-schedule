<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\AppointmentHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckAvailableTimeController extends Controller
{
    /**
     * @var AppointmentHandler
     */
    private $handler;

    /**
     * CheckAvailableTimeController constructor.
     * @param AppointmentHandler|null $handler
     */
    public function __construct(AppointmentHandler $handler = null)
    {
        $this->handler = $handler ?? new AppointmentHandler();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function post(Request $request)
    {
        return $this->handler->checkTime($request->get("datetime_start"));
    }

    /**
     * @param string $startDateTime
     * @return JsonResponse
     */
    public function get(string $startDateTime)
    {
        return $this->handler->checkTime($startDateTime);
    }
}
