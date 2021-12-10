<?php
declare(strict_types=1);

namespace VetSchedule\Application;

use VetSchedule\Domain\DateTimeCheck;
use VetSchedule\Domain\Schedule;
use VetSchedule\Domain\SchedulingService;
use VetSchedule\Exceptions\InvalidDateTimeException;

class CheckAvailableTimeQueryHandler
{
    /**
     * @var SchedulingService
     */
    private $repository;

    /**
     * @var CheckAvailableTimeDtoAssembler
     */
    private $dtoAssembler;

    /**
     * CheckAvailableTimeQueryHandler constructor.
     * @param SchedulingService              $repository
     * @param CheckAvailableTimeDtoAssembler $dtoAssembler
     */
    public function __construct(SchedulingService $repository, CheckAvailableTimeDtoAssembler $dtoAssembler)
    {
        $this->repository   = $repository;
        $this->dtoAssembler = $dtoAssembler;
    }

    /**
     * @param string $dateTimeStart
     * @return CheckAvailableTimeDtoAssembler
     * @throws \Exception
     */
    public function execute(string $dateTimeStart): CheckAvailableTimeDtoAssembler
    {


        $appointments = $this->repository->retrieveAppointments();
        $schedule     = Schedule::createFromArray($appointments);
        $this->dtoAssembler->assemble($schedule->isAvailableDateTime(DateTimeCheck::create($dateTimeStart)->value()));
        return $this->dtoAssembler;
    }
}
