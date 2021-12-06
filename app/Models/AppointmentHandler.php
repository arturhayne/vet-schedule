<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Http\JsonResponse;

class AppointmentHandler
{

    const DEFAULT_SOURCE_PATH = __DIR__ . '/../data/blocks.json';

    /**
     * @param string $startDateTime
     * @return JsonResponse
     */
    public function checkTime(string $startDateTime): JsonResponse
    {
        if (!$this->isValidDate($startDateTime)) {
            return CheckDateTimeResponse::createInvalidResponse();
        }

        try {
            $blockedAppointments = $this->retrieveAppointmentsFromFile();

            $appointments = Appointments::createFromArray($blockedAppointments);

            if ($appointments->isAvailableDateTime(new \DateTime($startDateTime))) {
                return CheckDateTimeResponse::createAvailableResponse();
            }

            return CheckDateTimeResponse::createNotAvailableResponse();

        } catch (\Exception $e) {
            return CheckDateTimeResponse::createInvalidResponse();
        }
    }

    /**
     * @param string $dateTime
     * @return bool
     */
    private function isValidDate(string $dateTime): bool
    {
        if (empty(trim($dateTime)) || !strtotime($dateTime)) {
            return false;
        }

        return true;
    }

    /**
     * @return void
     * @throws \Exception
     */
    private function retrieveAppointmentsFromFile(): array
    {
        $stringFile = file_get_contents(self::DEFAULT_SOURCE_PATH);

        return json_decode($stringFile, true);
    }
}
