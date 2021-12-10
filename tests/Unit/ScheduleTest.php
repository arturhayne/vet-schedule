<?php
declare(strict_types=1);

namespace Unit;

use VetSchedule\Domain\Appointment;
use VetSchedule\Domain\Schedule;

class ScheduleTest extends \TestCase
{
    /**
     * @test
     * @throws \Exception
     */
    public function it_should_return_is_available_time_true_when_there_is_no_appointment_conflicts(): void
    {
        $appointmentWithOutConflict = $this->createMock(Appointment::class);
        $appointmentWithOutConflict->method('schedulingConflict')->willReturn(false);

        $appointments = [$appointmentWithOutConflict];
        $schedule = new Schedule($appointments);

        $this->assertTrue($schedule->isAvailableDateTime(new \DateTime()));
    }

    /**
     * @test
     * @throws \Exception
     */
    public function it_should_return_is_available_time_false_when_there_is_an_appointment_conflict(): void
    {
        $appointmentWithConflict = $this->createMock(Appointment::class);
        $appointmentWithConflict->method('schedulingConflict')->willReturn(true);

        $appointmentWithOutConflict = $this->createMock(Appointment::class);
        $appointmentWithOutConflict->method('schedulingConflict')->willReturn(false);

        $appointments = [$appointmentWithOutConflict, $appointmentWithConflict];
        $schedule = new Schedule($appointments);

        $this->assertFalse($schedule->isAvailableDateTime(new \DateTime()));
    }
}
