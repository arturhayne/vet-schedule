<?php
declare(strict_types=1);

namespace App\Models;

class Appointments
{
    const DEFAULT_SOURCE_PATH = __DIR__ . '/../../data/blocks.json';

    /**
     * @var array
     */
    private $appointments;

    /**
     * Appointments constructor.
     * @param array $appointments
     */
    public function __construct(array $appointments)
    {
        $this->appointments = $appointments;
    }

    /**
     * @param \DateTime $dateTime
     * @return bool
     * @throws \Exception
     */
    public function isAvailableDateTime(\DateTime $dateTime): bool
    {
        /** @var Appointment $appointment */
        foreach ($this->appointments() as $appointment) {
            if ($appointment->schedulingConflict($dateTime)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array $appointmentsArray
     * @return static
     * @throws \Exception
     */
    public static function createFromArray(array $appointmentsArray): self
    {
        $appointments = [];
        foreach ($appointmentsArray as $appointment) {
            $appointment = Appointment::createFromArray($appointment);
            $appointments[] = $appointment;
        }

        return new static ($appointments);
    }

    /**
     * @return array
     */
    private function appointments()
    {
        return $this->appointments;
    }
}
