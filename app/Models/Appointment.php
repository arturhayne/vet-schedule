<?php
declare(strict_types=1);

namespace App\Models;

use DateInterval;

class Appointment
{
    const APPOINTMENT_HOURS_DURATION = 1;

    /**
     * @var \DateTime
     */
    private $dateFrom;

    /**
     * @var \DateTime
     */
    private $dateTo;

    /**
     * @var string
     */
    private $label;

    /**
     * Appointment constructor.
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param string    $label
     */
    public function __construct(\DateTime $dateFrom, \DateTime $dateTo, string $label)
    {
        $this->dateFrom = $dateFrom;
        $this->dateTo   = $dateTo;
        $this->label    = $label;
    }

    /**
     * @param array $appointmentArray
     * @return Appointment
     * @throws \Exception
     */
    public static function createFromArray(array $appointmentArray): self
    {
        return new static(
            new \DateTime($appointmentArray["datetime_from"]),
            new \DateTime($appointmentArray["datetime_to"]),
            $appointmentArray["label"],
        );
    }

    /**
     * @return \DateTime
     */
    public function dateFrom(): \DateTime
    {
        return $this->dateFrom;
    }

    /**
     * @return \DateTime
     */
    public function dateTo(): \DateTime
    {
        return $this->dateTo;
    }

    /**
     * @return string
     */
    public function label(): string
    {
        return $this->label;
    }

    /**
     * @param \DateTime $bookStartTime
     * @return bool
     * @throws \Exception
     */
    public function schedulingConflict(\DateTime $bookStartTime): bool
    {
        if($this->startTimeConflicts($bookStartTime)) {
            return true;
        }

        if($this->endTimeConflicts($bookStartTime)) {
            return true;
        }

        return  false;
    }

    /**
     * @param \DateTime $bookStartTime
     * @return bool
     * @throws \Exception
     */
    private function endTimeConflicts(\DateTime $bookStartTime): bool
    {
        $bookEndTime  = clone $bookStartTime;
        $bookEndTime->add(new DateInterval('PT' . self::APPOINTMENT_HOURS_DURATION . 'H'));
        return $bookEndTime < $this->dateTo() && $bookEndTime > $this->dateFrom();
    }

    /**
     * @param \DateTime $bookStartTime
     * @return bool
     */
    private function startTimeConflicts(\DateTime $bookStartTime): bool
    {
        return $bookStartTime >= $this->dateFrom() && $bookStartTime < $this->dateTo();
    }
}
