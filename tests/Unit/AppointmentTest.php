<?php
declare(strict_types=1);

use App\Models\Appointment;

class AppointmentTest extends TestCase
{
    /**
     * @test
     * @throws \Exception
     */
    public function it_should_return_scheduling_conflict_when_appointment_was_taken(): void
    {
        //GIVEN
        $now            = new \DateTime();
        $nowPlusOneHour = (new \DateTime())->add(new DateInterval('PT1H'));
        $bookTentative  = new \DateTime();

        //WHEN
        $appointment = new Appointment($now, $nowPlusOneHour, 'Appointment');

        //THEN
        $this->assertTrue($appointment->schedulingConflict($bookTentative));
    }

    /**
     * @test
     * @throws \Exception
     */
    public function it_should_return_scheduling_conflict_when_appointment_was_taken_from_half_time_before(): void
    {
        //GIVEN
        $nowPlusOneHour                      = (new \DateTime())->add(new DateInterval('PT1H'));
        $nowPlusTwoHours                     = (new \DateTime())->add(new DateInterval('PT2H'));
        $bookTentativeConflicting30MinBefore = (new \DateTime())->add(new DateInterval('PT30M'));

        //WHEN
        $appointment = new Appointment($nowPlusOneHour, $nowPlusTwoHours, 'Appointment');

        //THEN
        $this->assertTrue($appointment->schedulingConflict($bookTentativeConflicting30MinBefore));
    }

    /**
     * @test
     * @throws \Exception
     */
    public function it_should_not_return_scheduling_conflict_when_appointment_was_not_taken(): void
    {
        //GIVEN
        $now            = new \DateTime();
        $nowPlusOneHour = (new \DateTime())->add(new DateInterval('PT1H'));
        $bookTentative  = (new \DateTime())->add(new DateInterval('PT1H'));

        //When
        $appointment = new Appointment($now, $nowPlusOneHour, 'Appointment');

        //THEN
        $this->assertFalse($appointment->schedulingConflict($bookTentative));
    }
}
