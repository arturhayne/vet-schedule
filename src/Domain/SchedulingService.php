<?php
declare(strict_types=1);

namespace VetSchedule\Domain;

interface SchedulingService
{
    /**
     * @return Schedule
     */
    public function retrieveAppointments(): array;
}
