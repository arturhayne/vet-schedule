<?php
declare(strict_types=1);

namespace VetSchedule\Application;

class HttpCheckAvailableTimeDto implements \JsonSerializable, CheckAvailableTimeDtoAssembler
{
    /**
     * @var array
     */
    private $response;

    /**
     * @param bool $timeIsAvailable
     */
    public function assemble(bool $timeIsAvailable): void
    {
        $this->response = $this->createResponse($timeIsAvailable);
    }

    /**
     * @param bool $timeIsAvailable
     * @return array
     */
    private function createResponse(bool $timeIsAvailable): array
    {
        if ($timeIsAvailable) {
            return $this->availableResponse();
        }

        return $this->notAvailableResponse();
    }

    /**
     * @return array
     */
    private function availableResponse(): array
    {
        return [
            'status'    => 'success',
            'message'   => 'The datetime_start is available.',
            'available' => true
        ];
    }

    /**
     * @return array
     */
    private function notAvailableResponse(): array
    {
        return [
            'status'    => 'success',
            'message'   => 'The datetime_start is not available.',
            'available' => false
        ];
    }

    public function jsonSerialize()
    {
        return $this->response;
    }
}
