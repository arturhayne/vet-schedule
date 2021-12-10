<?php
declare(strict_types=1);

namespace VetSchedule\Infrastructure;

use VetSchedule\Domain\Schedule;
use VetSchedule\Domain\SchedulingService;

class FileAppointmentsRepository implements SchedulingService
{
    const DEFAULT_SOURCE_PATH = __DIR__ . '/../../data/blocks.json';

    /**
     * @var mixed|string
     */
    private $sourcePath;

    /**
     * FileAppointmentsRepository constructor.
     * @param $sourcePath
     */
    public function __construct($sourcePath = self::DEFAULT_SOURCE_PATH)
    {
        $this->sourcePath = $sourcePath;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function retrieveAppointments(): array
    {
        $stringFile = file_get_contents($this->sourcePath);

        return json_decode($stringFile, true);
    }
}
