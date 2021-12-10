<?php
declare(strict_types=1);

namespace Unit;

use VetSchedule\Domain\Appointment;
use VetSchedule\Domain\Schedule;
use VetSchedule\Infrastructure\FileAppointmentsRepository;

class FileAppointmentsRepositoryTest extends \TestCase
{
    /**
     * @test
     * @throws \Exception
     */
    public function it_should_return_appointments(): void
    {
        $repository = new FileAppointmentsRepository();

        $appointments = $repository->retrieveAppointments();

        $this->assertNotEmpty($appointments);
        $this->assertArrayHasKey("datetime_from", $appointments[0]);
        $this->assertArrayHasKey("datetime_to", $appointments[0]);
        $this->assertArrayHasKey("label", $appointments[0]);
    }
}
